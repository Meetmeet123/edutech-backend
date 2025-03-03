<?php

namespace App\Http\Controllers;

use App\Mail\Sendmail;
use App\Models\AppSetting;
use App\Models\DesignationHistory;
use App\Models\Education;
use App\Models\EmailConfig;
use App\Models\LeaveApplication;
use App\Models\Users;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;
use DateTime;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Firebase\JWT\JWT;
use App\Models\Role;
use App\Models\SalaryHistory;
use Illuminate\Support\Facades\Mail;

//
class UsersController extends Controller
{
    public function login(Request $request): JsonResponse
    {
        try {
            $allUser = Users::all();
            $users = json_decode($allUser, true);
            global $isValid;
            foreach ($users as $user) {

                $isValid = $user['username'] == $request['username'] && Hash::check($request['password'], $user['password']);

                $permissions = Role::with('RolePermission.permission')
                    ->where('id', $user['roleId'])
                    ->first();

                $permissionNames = $permissions->RolePermission->map(function ($rp) {
                    return $rp->permission->name;
                });
                if ($isValid) {
                    $userType = Role::where('id', $user['roleId'])->first();

                    $token = array(
                        "sub" => $user['id'],
                        "role" => $userType->name,
                        "permissions" => $permissionNames,
                        "exp" => time() + 86400
                    );

                    $jwt = JWT::encode($token, env('JWT_SECRET'), 'HS256');

                    $userWithoutPassword = $user;
                    unset($userWithoutPassword['password']);
                    $userWithoutPassword['token'] = $jwt;
                    return response()->json($userWithoutPassword);
                }
            }

            return response()->json(['error' => 'Invalid username or password'], 401);
        } catch (Exception $error) {
            return response()->json(['error' => 'An error occurred during login. Please try again later.'], 500);
        }
    }

    public function register(Request $request): JsonResponse
    {
        try {
            $joinDate = new DateTime($request->input('joinDate'));
            $leaveDate = $request->input('leaveDate') !== null ? new DateTime($request->input('leaveDate')) : null;

            $designationStartDate = Carbon::parse($request->input('designationStartDate'));
            $designationEndDate = $request->input('designationEndDate') ? Carbon::parse($request->input('designationEndDate')) : null;

            $salaryStartDate = Carbon::parse($request->input('salaryStartDate'));
            $salaryEndDate = $request->input('salaryEndDate') ? Carbon::parse($request->input('salaryEndDate')) : null;

            $hash = Hash::make($request->input('password'));

            $createUser = Users::create([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('lastName'),
                'username' => $request->input('username'),
                'password' => $hash,
                'email' => $request->input('email'),
                'phone' => $request->input('phone') ?? null,
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'state' => $request->input('state'),
                'zipCode' => $request->input('zipCode'),
                'country' => $request->input('country'),
                'joinDate' => $joinDate->format('Y-m-d H:i:s'),
                'leaveDate' => $leaveDate?->format('Y-m-d H:i:s'),
                'employeeId' => $request->input('employeeId'),
                'bloodGroup' => $request->input('bloodGroup'),
                'image' => $request->input('image'),
                'employmentStatusId' => $request->input('employmentStatusId'),
                'departmentId' => $request->input('departmentId'),
                'roleId' => $request->input('roleId'),
                'shiftId' => $request->input('shiftId'),
                'leavePolicyId' => $request->input('leavePolicyId'),
                'weeklyHolidayId' => $request->input('weeklyHolidayId'),
            ]);

            //designation history
            $designationHistoryData = DesignationHistory::create([
                'userId' => $createUser->id,
                'designationId' => $request->input('designationId'),
                'startDate' => $designationStartDate,
                'endDate' => $designationEndDate ?? null,
                'comment' => $request->input('comment') ?? null,
            ]);

            //salary history
            $salaryHistoryData = SalaryHistory::create([
                'userId' => $createUser->id,
                'salary' => $request->input('salary'),
                'startDate' => $salaryStartDate,
                'endDate' => $salaryEndDate ?? null,
                'comment' => $request->input('salaryComment') ?? null,
            ]);

            //education
            $educations = $request->input('education') ?? null;
            $educationData = [];
            foreach ($educations as $education) {
                $startDate = new DateTime($education['studyStartDate']) ?? null;
                $endDate = isset($education['studyEndDate']) ? new DateTime($education['studyEndDate']) : null;
                $educationData[] = [
                    'userId' => $createUser->id,
                    'degree' => $education['degree'],
                    'institution' => $education['institution'],
                    'fieldOfStudy' => $education['fieldOfStudy'],
                    'result' => $education['result'],
                    'studyStartDate' => $startDate->format('Y-m-d H:i:s'),
                    'studyEndDate' => $endDate ? $endDate->format('Y-m-d H:i:s') : null,
                ];
            }

            $educationCreated = collect($educationData)->map(function ($item) {
                $startDate = Carbon::parse($item['studyStartDate']);
                $endDate = isset($item['studyEndDate']) ? Carbon::parse($item['studyEndDate']) : null;

                return Education::create([
                    'userId' => $item['userId'],
                    'degree' => $item['degree'],
                    'institution' => $item['institution'],
                    'fieldOfStudy' => $item['fieldOfStudy'],
                    'result' => $item['result'],
                    'studyStartDate' => $startDate,
                    'studyEndDate' => $endDate ?? null,
                ]);
            });

            if ($createUser) {
                $emailConfig = EmailConfig::first();
                $companyName = AppSetting::first();

                if (!$emailConfig) {
                    return response()->json(['error' => 'SMTP not configured properly!'], 404);
                }

                try {
                    //set the config
                    config([
                        'mail.mailers.smtp.host' => $emailConfig->emailHost,
                        'mail.mailers.smtp.port' => $emailConfig->emailPort,
                        'mail.mailers.smtp.encryption' => $emailConfig->emailEncryption,
                        'mail.mailers.smtp.username' => $emailConfig->emailUser,
                        'mail.mailers.smtp.password' => $emailConfig->emailPass,
                        'mail.mailers.smtp.local_domain' => env('MAIL_EHLO_DOMAIN'),
                        'mail.from.address' => $emailConfig->emailUser,
                        'mail.from.name' => $emailConfig->emailConfigName,
                    ]);

                    $mailData = [
                        'title' => "New Account",
                        "name" => $createUser->firstName . " " . $createUser->lastName,
                        "email" => $request->email,
                        "password" => $request->password,
                        "body" => " ",
                        "companyName" => $companyName->companyName,
                    ];
                    Mail::to($createUser->email)->send(new Sendmail($mailData));
                } catch (Exception $err) {
                    return response()->json(['error' => 'Failed to send email, SMTP not configured properly!'], 400);
                }
            }

            $userWithoutPassword = (array)$request->all();
            unset($userWithoutPassword['password']);

            return response()->json($userWithoutPassword, 201);
        } catch (Exception $error) {
            return response()->json([
                'error' =>  'An error occurred during Registration. Please try again later.', $error->getMessage()
            ], 500);
        }
    }

    public function getAllUser(Request $req): JsonResponse
    {
        if ($req->query('query') === 'all') {
            try {
                $allUser = Users::with([
                    'employmentStatus',
                    'department',
                    'role',
                    'shift',
                    'leavePolicy',
                    'weeklyHoliday',
                    'designationHistory.designation',
                    'salaryHistory',
                    'education'
                ])
                    ->where('status', 'true')
                    ->orderBy('id', "desc")
                    ->get();

                $filteredUsers = $allUser->map(function ($u) {
                    return $u->makeHidden('password')->toArray();
                });

                $converted = arrayKeysToCamelCase($filteredUsers->toArray());
                return response()->json($converted, 200);
            } catch (Exception $error) {
                return response()->json(['error' => 'An error occurred during getting user. Please try again later.'], 500);
            }
        } elseif ($req->query('status')) {
            try {
                $pagination = getPagination($req->query());
                $allUser = Users::where('status', $req->query('status'))->with([
                    'employmentStatus',
                    'department',
                    'role',
                    'shift',
                    'leavePolicy',
                    'weeklyHoliday',
                    'designationHistory.designation',
                    'salaryHistory',
                    'education'
                ])
                    ->orderBy('id', "desc")
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $filteredUsers = $allUser->map(function ($u) {
                    return $u->makeHidden('password')->toArray();
                });
                $converted = arrayKeysToCamelCase($filteredUsers->toArray());


                $aggregation = [
                    'getAllUser' => $converted,
                    'totalUser' => Users::where('status', $req->query('status'))->count()
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $error) {
                return response()->json(['error' => 'An error occurred during getting user. Please try again later.'], 500);
            }
        } else {
            try {
                $pagination = getPagination($req->query());
                $allUser = Users::where('status', "true")->with([
                    'employmentStatus',
                    'department',
                    'role',
                    'shift',
                    'leavePolicy',
                    'weeklyHoliday',
                    'designationHistory.designation',
                    'salaryHistory',
                    'education'
                ])
                    ->orderBy('id', "desc")
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $filteredUsers = $allUser->map(function ($u) {
                    return $u->makeHidden('password')->toArray();
                });
                $converted = arrayKeysToCamelCase($filteredUsers->toArray());

                $aggregation = [
                    'getAllUser' => $converted,
                    'totalUser' => Users::where('status', 'true')->count()
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $error) {
                return response()->json(['error' => 'An error occurred during getting user. Please try again later.'], 500);
            }
        }
    }

    public function getSingleUser(Request $request): JsonResponse
    {
        try {
            $data = $request->attributes->get("data");

            if ($data['sub'] !== (int)$request['id'] && $data['role'] !== 'admin') {
                return response()->json(['error' => 'Unauthorized'], 401);
            }

            $singleUser = Users::with(
                'designationHistory.designation',
                'salaryHistory',
                'education',
                'employmentStatus',
                'department',
                'role',
                'shift',
                'leavePolicy',
                'weeklyHoliday',
                'awardHistory.award',
                'leaveApplication',
                'attendance'
            )->where('id', $request['id'])->first();

            // calculate paid and unpaid leave days for the user for the current year
            $currentYear = date('Y'); // Get the current year
            $startDate = Carbon::create($currentYear, 1, 1);
            $endDate = Carbon::create($currentYear, 12, 31);
            $leaveApplications = LeaveApplication::where('userId', $singleUser->id)
                ->where('status', 'ACCEPTED')
                ->where('acceptLeaveFrom', '>=', $startDate)
                ->where('acceptLeaveTo', '<=', $endDate)
                ->get();


            $paidLeaveDays = $leaveApplications->filter(function ($l) {
                return $l->leaveType === "PAID";
            })->sum('leaveDuration');

            $unpaidLeaveDays = $leaveApplications->filter(function ($l) {
                return $l->leaveType === "UNPAID";
            })->sum('leaveDuration');

            // Calculate left paid and unpaid leave days
            $leftPaidLeaveDays = $singleUser->leavePolicy->paidLeaveCount - $paidLeaveDays;
            $leftUnpaidLeaveDays = $singleUser->leavePolicy->unpaidLeaveCount - $unpaidLeaveDays;

            $userData = $singleUser->toArray();
            $userData['paidLeaveDays'] = $paidLeaveDays;
            $userData['unpaidLeaveDays'] = $unpaidLeaveDays;
            $userData['leftPaidLeaveDays'] = $leftPaidLeaveDays;
            $userData['leftUnpaidLeaveDays'] = $leftUnpaidLeaveDays;

            unset($userData['password']);
            $userData = arrayKeysToCamelCase($userData);
            return response()->json($userData, 200);
        } catch (Exception $error) {
            return response()->json(['error' => 'An error occurred during getting user. Please try again later.'], 500);
        }
    }

    public function updateSingleUser(Request $request, $id): JsonResponse
    {
        try {

            $joinDate = Carbon::parse($request->input('joinDate'));
            $leaveDate = $request->input('leaveDate') ? Carbon::parse($request->input('leaveDate')) : null;
            $hash = Hash::make($request->input('password'));
            //merge the data
            $request->merge([
                'joinDate' => $joinDate ?? null,
                'leaveDate' => $leaveDate ?? null,
                'password' => $hash,
            ]);


            $user = Users::findOrFail($id);
            $user->Update($request->all());
            $userWithoutPassword = $user->toArray();
            unset($userWithoutPassword['password']);

            $converted = arrayKeysToCamelCase($userWithoutPassword);
            return response()->json($converted, 200);
        } catch (Exception $error) {
            return response()->json(['error' => 'An error occurred during getting user. Please try again later.'], 500);
        }
    }

    public function deleteUser(Request $request, $id): JsonResponse
    {
        try {
            //update the status
            $user = Users::findOrFail($id);
            $user->status = $request->input('status');
            $user->save();
            return response()->json(['message' => 'User deleted successfully'], 200);
        } catch (Exception $error) {
            return response()->json(['error' => $error->getMessage()], 500);
        }
    }
}
