<?php

namespace App\Http\Controllers;


use App\Models\SalaryHistory;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Exception;
use Illuminate\Http\JsonResponse;

//
class DashboardController extends Controller
{
    public function getDashboardData(): JsonResponse
    {
        try {
            //total user count
            $userCount = Users::count();


            $userSalary = SalaryHistory::orderBy('id', 'desc')->get();
            $salary = 0;
            foreach ($userSalary as $key => $value) {
                $salary += $value->salary;
            }

            // Get the current date and time
            $today = Carbon::now();

            // Calculate the start and end time for the current day
            $startTime = $today->copy()->startOfDay();
            $endTime = $today->copy()->endOfDay();

            // Query the attendance table to get records for the current day
            $attendance = DB::table('attendance')
                ->where('inTime', '>=', $startTime)
                ->where('inTime', '<', $endTime)
                ->get();

            // Calculate total unique users from attendance
            $todayPresent = count($attendance->unique('userId'));

            // Calculate the start and end time for today
            $startTime = $today->copy()->startOfDay();
            $endTime = $today->copy()->endOfDay();

            // Query the leaveApplication table to count users on leave for today
            $todayOnLeave = DB::table('leaveApplication')
                ->where('acceptLeaveFrom', '<=', $endTime)
                ->where('acceptLeaveTo', '>=', $startTime)
                ->where('status', '=', 'ACCEPTED')
                ->count();
            // Assuming you have calculated totalUsers, todayPresent, and todayOnLeave
            $todayAbsent = $userCount - $todayPresent - $todayOnLeave;

            // Get start and end dates from the request query parameters
            $startDate = Carbon::parse(request('startdate'));
            $endDate = Carbon::parse(request('enddate'));

            // Query the attendance table to get work hours between the start and end dates
            $workHours = DB::table('attendance')
                ->where('inTime', '>=', $startDate)
                ->where('inTime', '<=', $endDate)
                ->get();

            // Calculate totalHour for each day
            $workHoursDateWise = [];
            foreach ($workHours as $user) {
                $date = Carbon::parse($user->inTime)->format('Y-m-d');
                $totalHour = $user->totalHour;

                if (isset($workHoursDateWise[$date])) {
                    $workHoursDateWise[$date] += $totalHour;
                } else {
                    $workHoursDateWise[$date] = $totalHour;
                }
            }

            // Convert the associative array to the desired format
            $workHoursByDate = [];
            foreach ($workHoursDateWise as $date => $time) {
                $formattedDate = Carbon::parse($date)->toDateString();
                $formattedTime = number_format($time, 2);

                $workHoursByDate[] = [
                    'type' => 'Work hours',
                    'date' => $formattedDate,
                    'time' => (float)$formattedTime,
                ];
            }

            $data = [
                'totalUsers' => $userCount,
                'totalSalary' => $salary,
                'todayPresent' => $todayPresent,
                'todayOnLeave' => $todayOnLeave,
                'todayAbsent' => $todayAbsent,
                'workHoursByDate' => $workHoursByDate,
            ];

            return response()->json($data);
        } catch (Exception $exception) {
            return response()->json(['error' => 'An error occurred during getting Dashboard Data. Please try again later.'], 500);
        }
    }
}
