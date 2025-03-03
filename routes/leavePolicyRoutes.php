<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeavePolicyController;

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

Route::middleware('permission:create-leavePolicy')->post("/", [LeavePolicyController::class, 'createSingleLeavePolicy']);

Route::middleware('permission:readAll-leavePolicy')->get("/", [LeavePolicyController::class, 'getAllLeavePolicy']);

Route::middleware('permission:readSingle-leavePolicy')->get("/{id}", [LeavePolicyController::class, 'getSingleLeavePolicy']);

Route::middleware('permission:update-leavePolicy')->put("/{id}", [LeavePolicyController::class, 'updateSingleLeavePolicy']);

Route::middleware('permission:delete-leavePolicy')->delete("/{id}", [LeavePolicyController::class, 'deleteSingleLeavePolicy']);
