<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\AppSettingController;
use App\Http\Controllers\GeneralSettingController;
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

Route::middleware("permission:readAll-setting")->get('/', [AppSettingController::class, 'getSingleAppSetting']);
Route::middleware(["permission:update-setting", 'fileUploader:1'])->put("/", [AppSettingController::class, 'updateAppSetting']);
Route::middleware("permission:readAll-setting")->get('/general-setting', [GeneralSettingController::class, 'index']);
Route::middleware(["permission:update-setting"])->post('/general-setting', [GeneralSettingController::class, 'store']);
Route::middleware(["permission:update-setting", 'fileUploader:1'])->post('/general-setting/upload-logo', [GeneralSettingController::class, 'uploadLogo']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-theme', [GeneralSettingController::class, 'updateTheme']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-mobile-app', [GeneralSettingController::class, 'updateMobileAppSettings']);
Route::middleware(["permission:update-setting"])->post('/general-setting/register-android-app', [GeneralSettingController::class, 'registerAndroidApp']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-student-guardian', [GeneralSettingController::class, 'updateStudentGuardianSettings']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-fee-settings', [GeneralSettingController::class, 'updateFeeSettings']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-id-auto-generation', [GeneralSettingController::class, 'updateIdAutoGenerationSettings']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-attendance-type', [GeneralSettingController::class, 'updateAttendanceTypeSettings']);
Route::middleware(["permission:update-setting"])->post('/general-setting/save-class-section-times', [GeneralSettingController::class, 'saveClassSectionTimes']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-maintenance-mode', [GeneralSettingController::class, 'updateMaintenanceMode']);
Route::middleware(["permission:update-setting"])->post('/general-setting/update-miscellaneous', [GeneralSettingController::class, 'updateMiscellaneousSettings']);
