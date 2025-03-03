<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;


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


Route::middleware('permission:')->post("/", [AttendanceController::class, 'createAttendance']);

Route::middleware('permission:')->get("/", [AttendanceController::class, 'getAllAttendance']);

Route::middleware('permission:')->get("/{id}", [AttendanceController::class, 'getSingleAttendance']);

Route::middleware('permission:')->get("/{id}/user", [AttendanceController::class, 'getAttendanceByUserId']);

Route::middleware('permission:')->get("/{id}/last", [AttendanceController::class, 'getLastAttendanceByUserId']);
