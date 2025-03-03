<?php

namespace App\Http\Controllers;

use App\Mail\Sendmail;
use App\Models\AppSetting;
use App\Models\EmailConfig;
use App\Models\Payslip;
use App\Models\Transaction;
use App\Services\CalculatePayslipService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class PayrollController extends Controller
{
    protected CalculatePayslipService $calculatePayslipService;

    public function __construct(CalculatePayslipService $calculatePayslip)
    {
        $this->calculatePayslipService = $calculatePayslip;
    }

    //calculate payroll
    public function calculatePayroll(Request $request): JsonResponse
    {
        try {
            $salaryMonth = $request->query('salaryMonth');
            $salaryYear = $request->query('salaryYear');

            $result = $this->calculatePayslipService->calculatePayslip($salaryMonth, $salaryYear);

            return response()->json($result, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
        }
    }

    // generate generatePayslip controller method
    public function generatePayslip(Request $request): JsonResponse
    {
        try {
            $data = json_decode($request->getContent(), true);

            $payslip = collect($data)->map(function ($item) {
                return Payslip::firstOrCreate([
                    'userId' => $item['userId'],
                    'salaryMonth' => $item['salaryMonth'],
                    'salaryYear' => $item['salaryYear'],
                    'salary' => $item['salary'],
                    'paidLeave' => $item['paidLeave'],
                    'unpaidLeave' => $item['unpaidLeave'],
                    'monthlyHoliday' => $item['monthlyHoliday'],
                    'publicHoliday' => $item['publicHoliday'],
                    'workDay' => $item['workDay'],
                    'shiftWiseWorkHour' => $item['shiftWiseWorkHour'],
                    'monthlyWorkHour' => $item['monthlyWorkHour'],
                    'hourlySalary' => $item['hourlySalary'],
                    'workingHour' => $item['workingHour'],
                    'salaryPayable' => $item['salaryPayable'],
                    'bonus' => $item['bonus'],
                    'bonusComment' => $item['bonusComment'],
                    'deduction' => $item['deduction'],
                    'deductionComment' => $item['deductionComment'],
                    'totalPayable' => ($item['salaryPayable'] + $item['bonus'] - $item['deduction']),
                ]);
            });

            $result = [
                'count' => count($payslip),
            ];
            return response()->json($result, 201);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
        }
    }

    // get all the payslip controller method
    public function getAllPayslip(Request $request): JsonResponse
    {
        if ($request->query('value') === 'monthWise') {
            $pagination = getPagination($request->query());
            $paymentStatus = $request->query('paymentStatus');
            $salaryMonth = $request->query('salaryMonth');
            $salaryYear = $request->query('salaryYear');

            try {
                $allPayslip = Payslip::with('user:id,firstName,lastName')
                    ->when($salaryMonth, fn ($query) => $query->where('salaryMonth', (int)$salaryMonth))
                    ->when($salaryYear, fn ($query) => $query->where('salaryYear', (int)$salaryYear))
                    ->when($paymentStatus, fn ($query) => $query->where('paymentStatus', $paymentStatus))
                    ->orderBy('id', 'desc')
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $converted = arrayKeysToCamelCase($allPayslip->toArray());
                $aggregation = [
                    'getAllPayslip' => $converted,
                    'totalPayslip' => Payslip::when($salaryMonth, fn ($query) => $query->where('salaryMonth', (int)$salaryMonth))
                        ->when($salaryYear, fn ($query) => $query->where('salaryYear', (int)$salaryYear))
                        ->when($paymentStatus, fn ($query) => $query->where('paymentStatus', $paymentStatus))->count(),
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
            }
        } else {
            try {
                $pagination = getPagination($request->query());
                $allPayslip = Payslip::with('user:id,firstName,lastName')
                    ->orderBy('id', 'desc')
                    ->skip($pagination['skip'])
                    ->take($pagination['limit'])
                    ->get();

                $converted = arrayKeysToCamelCase($allPayslip->toArray());
                $aggregation = [
                    'getAllPayslip' => $converted,
                    'totalPayslip' => Payslip::count()
                ];

                return response()->json($aggregation, 200);
            } catch (Exception $err) {
                return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
            }
        }
    }

    // get a single payslip controller method
    public function getSinglePayslip(Request $request, $id): JsonResponse
    {
        try {
            $singlePayslip = Payslip::with('user')
                ->where('id', (int)$id)
                ->first();

            unset($singlePayslip->user->password);

            $converted = arrayKeysToCamelCase($singlePayslip->toArray());
            return response()->json($converted, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
        }
    }

    // update payslip controller method
    public function updatePayslip(Request $request, $id): JsonResponse
    {
        try {
            $updatedPayslip = Payslip::where('id', (int)$id)
                ->first();
            $updatedPayslip->update([
                'bonus' => $request->input('bonus'),
                'bonusComment' => $request->input('bonusComment'),
                'deduction' => $request->input('deduction'),
                'deductionComment' => $request->input('deductionComment'),
            ]);

            $converted = arrayKeysToCamelCase($updatedPayslip->toArray());
            return response()->json($converted, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during update Payslip. Please try again later.'], 500);
        }
    }

    // make payment controller method
    public function makePayment(Request $request, $id): JsonResponse
    {
        try {

            $checkPayslip = Payslip::where('id', (int)$id)
                ->first();

            if ($checkPayslip->paymentStatus === 'PAID') {
                return response()->json(['error' => 'Payslip already Paid'], 400);
            }

            $updatedPayslip = Payslip::where('id', (int)$id)
                ->with('user:id,firstName,lastName,username,email,phone,employeeId')
                ->first();
            $updatedPayslip->update([
                'paymentStatus' => 'PAID',
            ]);

            $transaction = Transaction::create([
                'date' => carbon::now(),
                'debitId' => 10,
                'creditId' => 1,
                'particulars' => "Salary paid to {$updatedPayslip->user->firstName} {$updatedPayslip->user->lastName} for the month of {$updatedPayslip->salaryMonth}-{$updatedPayslip->salaryYear}",
                'amount' => $updatedPayslip->totalPayable,
                'type' => 'salary',
                'relatedId' => $updatedPayslip->id,
            ]);

            // make array keys to camelCase
            $convertedUpdatedPayslip = arrayKeysToCamelCase($updatedPayslip->toArray());
            $convertedTransaction = arrayKeysToCamelCase($transaction->toArray());

            $finalResult = [
                'updatedPayslip' => $convertedUpdatedPayslip,
                'transaction' => $convertedTransaction,
            ];


            $convertedDate = (Carbon::createFromDate($updatedPayslip->salaryYear, $updatedPayslip->salaryMonth, 1))->format('F-Y');
            if ($transaction) {
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
                        'title' => "Salary Payslip",
                        'companyName' => $companyName->companyName,
                        'companyEmail' => $companyName->email,
                        'companyPhone' => $companyName->phone,
                        'companyAddress' => $companyName->address,
                        "employeeId" => $updatedPayslip->user->employeeId,
                        "username" => $updatedPayslip->user->firstName . " " . $updatedPayslip->user->lastName,
                        "userEmail" => $updatedPayslip->user->email,
                        "userPhone" => $updatedPayslip->user->phone,
                        "salary" => $updatedPayslip->salary,
                        "workDay" => $updatedPayslip->workDay,
                        "workingHour" => $updatedPayslip->workingHour,
                        "salary" => $updatedPayslip->salary,
                        "paySlipFor" => $convertedDate,
                        "createdAt" => $updatedPayslip->created_at,
                        "status" => $updatedPayslip->paymentStatus,
                        "salaryPayable" => $updatedPayslip->salaryPayable,
                        "totalPayable" => $updatedPayslip->totalPayable,
                        "bonusComment" => $updatedPayslip->bonusComment,
                        "bonus" => $updatedPayslip->bonus,
                        "deductionComment" => $updatedPayslip->deductionComment,
                        "deduction" => $updatedPayslip->deduction,
                    ];
                    Mail::to($updatedPayslip->user->email)->send(new Sendmail($mailData));
                } catch (Exception $err) {
                    return response()->json(['error' => 'Failed to send email, SMTP not configured properly!'], 400);
                }
            }

            return response()->json($updatedPayslip, 200);
        } catch (Exception $err) {
            return response()->json(['error' => 'An error occurred during getting Payslip. Please try again later.'], 500);
        }
    }
}
