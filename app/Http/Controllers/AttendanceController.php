<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Users;
use Illuminate\Support\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AttendanceController extends Controller
{
    //create a single attendance controller method
    public function createAttendance(Request $request): JsonResponse
    {
        try {
            $tokenData = $request->attributes->get('data');
            $userId = (int) $request->input('userId');
            if (
                !($userId === $tokenData['sub']) &&
                !in_array("create-attendance", $tokenData['permissions'])
            ) {
                return response()->json([
                    'error' => 'Unauthorized. You are not authorized to give attendance',
                ], 401);
            }
            // get user shift
            $user = Users::where('id', $userId)
                ->with('shift')
                ->first();

            $userStartTime = Carbon::createFromFormat('Y-m-d H:i:s', $user->shift->startTime)->format('H:i:s');
            $userEndTime = Carbon::createFromFormat('Y-m-d H:i:s', $user->shift->endTime)->format('H:i:s');

            $currentTime = Carbon::now();
            $isLate = $currentTime->gt($userStartTime);
            $isEarly = $currentTime->lt($userStartTime);

            $attendance = Attendance::where('userId', $userId)
                ->where('outTime', null)
                ->first();

            if ($request->query('query') === 'manualPunch') {
                $inTime = Carbon::parse($request->input('inTime'));
                $outTime = Carbon::parse($request->input('outTime'));

                $isLateForManual = $inTime->gt($userStartTime);
                $isEarlyForManual = $inTime->lt($userStartTime);
                $isOutEarlyForManual = $outTime->lt($userEndTime);
                $isOutLateForManual = $outTime->gt($userEndTime);

                $diffInMinutes = abs($outTime->diffInMinutes($inTime));
                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;
                $totalHours = $hours + ($minutes / 60);

                $newAttendance = Attendance::create([
                    'userId' => $userId,
                    'inTime' => $inTime,
                    'outTime' => $outTime,
                    'punchBy' => $tokenData['sub'],
                    'inTimeStatus' => $isEarlyForManual ? "Early" : ($isLateForManual ? "Late" : "On Time"),
                    'outTimeStatus' => $isOutEarlyForManual ? "Early" : ($isOutLateForManual ? "Late" : "On Time"),
                    'comment' => $request->input('comment') ?: null,
                    'ip' => $request->input('ip') ?: null,
                    'totalHour' => (float) round($totalHours, 3),
                ]);

                $converted = arrayKeysToCamelCase($newAttendance->toArray());
                return response()->json($converted, 201);
            } else if ($attendance === null) {
                $inTime = Carbon::now();

                $newAttendance = Attendance::create([
                    'userId' => $userId,
                    'inTime' => $inTime,
                    'outTime' => null,
                    'punchBy' => $tokenData['sub'],
                    'inTimeStatus' => $isEarly ? "Early" : ($isLate ? "Late" : "On Time"),
                    'outTimeStatus' => null,
                    'comment' => $request->input('comment') ?: null,
                    'ip' => $request->input('ip') ?: null,
                ]);

                $converted = arrayKeysToCamelCase($newAttendance->toArray());
                return response()->json($converted, 201);
            } else {
                $outTime = Carbon::now();
                $inTime = Carbon::parse($attendance->inTime);

                $isOutEarly = $outTime->lt($userEndTime);
                $isOutLate = $outTime->gt($userEndTime);

                $diffInMinutes = abs($outTime->diffInMinutes($inTime));
                $hours = floor($diffInMinutes / 60);
                $minutes = $diffInMinutes % 60;
                $totalHours = $hours + ($minutes / 60);

                $newAttendance = Attendance::where('id', $attendance->id)
                    ->first();
                $newAttendance->update([
                    'outTime' => $outTime,
                    'totalHour' => (float) round($totalHours, 3),
                    'outTimeStatus' => $isOutEarly ? "Early" : ($isOutLate ? "Late" : "On Time"),
                ]);

                $converted = arrayKeysToCamelCase($newAttendance->toArray());
                return response()->json($converted, 201);
            }
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during creating attendance. Please try again later.'], 500);
        }
    }

    // get all the attendance controller method
    public function getAllAttendance(Request $request): JsonResponse
    {
        $tokenData = $request->attributes->get('data');
        if (!in_array('readAll-attendance', $tokenData['permissions'])) {
            return response()->json(['error' => 'unauthorized!'], 401);
        }

        if ($request->query('query') === 'all') {
            try {
                $getAllAttendance = Attendance::with('user:id,firstName,lastName')
                    ->where('status', 'true')
                    ->orderBy('id', 'asc')
                    ->get();

                $result = collect($getAllAttendance)->map(function ($attendance) {
                    $punchBy = Users::where('id', $attendance->punchBy)->select('id', 'firstName', 'lastName')->get();

                    return $attendance->setRelation('punchBy', $punchBy);
                });

                $converted = arrayKeysToCamelCase($result->toArray());
                return response()->json($converted, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting announcement. Please try again later.'], 500);
            }
        } else {
            try {
                $pagination = getPagination($request->query());
                $startDate = Carbon::parse($request->query('startdate'));
                $endDate = Carbon::parse($request->query('enddate'));

                $getAllAttendance = Attendance::with('user:id,firstName,lastName')
                    ->where('inTime', '>=', $startDate)
                    ->where('inTime', '<=', $endDate)
                    ->orderBy('id', 'asc')
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $result = collect($getAllAttendance)->map(function ($attendance) {
                    $punchBy = Users::where('id', $attendance->punchBy)->select('id', 'firstName', 'lastName')->get();
                    return $attendance->setRelation('punchBy', $punchBy);
                });

                $converted = arrayKeysToCamelCase($result->toArray());
                $aggregation = [
                    'getAllAttendance' => $converted,
                    'totalAttendance' => Attendance::where('status', 'true')->count(),
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting attendance. Please try again later.'], 500);
            }
        }
    }

    // get a single attendance controller method
    public function getSingleAttendance(Request $request, $id): JsonResponse
    {
        try {
            $getSingleAttendance = Attendance::with('user:id,firstName,lastName,email')
                ->where('id', $id)
                ->first();

            $punchBy = Users::where('id', $getSingleAttendance->punchBy)->select('id', 'firstName', 'lastName')->first();

            $getSingleAttendance->setRelation('punchBy', $punchBy);

            // authorize the user
            $tokenData = $request->attributes->get('data');
            if (!($tokenData['sub'] === $getSingleAttendance->userId)) {
                return response()->json(['error' => 'Unauthorized!'], 401);
            } else if (!in_array('readAll-attendance', $tokenData['permissions']) || !in_array('readSingle-attendance', $tokenData['permissions'])) {
                return response()->json(['error' => 'Unauthorized!'], 401);
            }

            $converted = arrayKeysToCamelCase($getSingleAttendance->toArray());
            return response()->json($converted, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting single attendance. Please try again later.'], 500);
        }
    }

    // get attendance by userId controller method
    public function getAttendanceByUserId(Request $request, $userId): JsonResponse
    {
        if ($request->query()) {
            try {
                $pagination = getPagination($request->query());
                $getAllAttendanceByUserId = Attendance::with('user:id,firstName,lastName')
                    ->where('userId', $userId)
                    ->orderBy('id', 'asc')
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $result = collect($getAllAttendanceByUserId)->map(function ($attendance) {
                    $punchBy = Users::where('id', $attendance->punchBy)->select('id', 'firstName', 'lastName')->get();
                    return $attendance->setRelation('punchBy', $punchBy);
                });

                $converted = arrayKeysToCamelCase($result->toArray());
                $aggregation = [
                    'getAllAttendanceByUserId' => $converted,
                    'totalAttendanceByUserId' => Attendance::where('userId', $userId)->count(),
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting attendance. Please try again later.'], 500);
            }
        } else {
            try {
                $getAllAttendanceByUserId = Attendance::with('user:id,firstName,lastName')
                    ->where('userId', $userId)
                    ->orderBy('id', 'asc')
                    ->get();

                $result = collect($getAllAttendanceByUserId)->map(function ($attendance) {
                    $punchBy = Users::where('id', $attendance->punchBy)->select('id', 'firstName', 'lastName')->get();
                    return $attendance->setRelation('punchBy', $punchBy);
                });

                $converted = arrayKeysToCamelCase($result->toArray());
                return response()->json($converted, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting attendance. Please try again later.'], 500);
            }
        }
    }

    // get last attendance by userId
    public function getLastAttendanceByUserId(Request $request, $userId): JsonResponse
    {
        try {
            $lastAttendance = Attendance::orderBy('id', 'desc')
                ->where('userId', $userId)
                ->first();

            $converted = arrayKeysToCamelCase($lastAttendance->toArray());
            return response()->json($converted, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting attendance. Please try again later.'], 500);
        }
    }
}
