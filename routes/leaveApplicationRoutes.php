<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveApplicationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('permission:')->post("/", [LeaveApplicationController::class, 'createSingleLeave']);

Route::middleware('permission:')->get("/", [LeaveApplicationController::class, 'getAllLeave']);

Route::middleware('permission:')->get("/{id}", [LeaveApplicationController::class, 'getSingleLeave']);

Route::middleware('permission:update-leaveApplication')->put("/{id}", [LeaveApplicationController::class, 'grantedLeave']);

Route::middleware('permission:')->get("/{id}/leaveHistory", [LeaveApplicationController::class, 'getLeaveByUserId']);
