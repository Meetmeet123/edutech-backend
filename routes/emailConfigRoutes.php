<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmailConfigController;


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


Route::middleware('permission:readSingle-emailConfig')->get("/", [EmailConfigController::class, 'getSingleEmailConfig']);

Route::middleware('permission:update-emailConfig')->put("/", [EmailConfigController::class, 'updateEmailConfig']);
