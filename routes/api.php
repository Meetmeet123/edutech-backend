<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\SettingController;
use App\Http\Controllers\API\SessionController;
use App\Http\Controllers\API\NotificationSettingController;
use App\Http\Controllers\API\SmsConfigController;
use App\Http\Controllers\API\EmailConfigController;
use App\Http\Controllers\API\PaymentSettingController;
use App\Http\Controllers\API\FrontCmsSettingController;
use App\Http\Controllers\API\RoleController;
use App\Http\Controllers\API\LanguageController;
use App\Http\Controllers\API\CurrencyController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\ModuleController;
use App\Http\Controllers\API\CustomFieldController;
use App\Http\Controllers\API\CaptchaController;
use App\Http\Controllers\API\SystemFieldController;
use App\Http\Controllers\API\FiletypeController;
use App\Http\Controllers\API\SidebarmenuController;
use App\Http\Controllers\API\UpdaterController;
use App\Http\Controllers\API\WhatsappConfigController;
use App\Http\Controllers\API\CertificateController;
use App\Http\Controllers\API\BackupController;
use App\Http\Controllers\API\EnquiryController;
use App\Http\Controllers\API\VisitorsController;
use App\Http\Controllers\API\GeneralCallController;
use App\Http\Controllers\API\DispatchController;
use App\Http\Controllers\API\ComplaintController;
use App\Http\Controllers\API\VisitorsPurposeController;
use App\Http\Controllers\API\ComplaintTypeController;
use App\Http\Controllers\API\SourceController;
use App\Http\Controllers\API\ReferenceController;
use App\Http\Controllers\API\ExamGroupController;
use App\Http\Controllers\API\ExamPatternController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Settings
Route::prefix('settings')->group(function () {
    Route::get('/mysql-version', [SettingController::class, 'getMysqlVersion']);
    Route::get('/sql-mode', [SettingController::class, 'getSqlMode']);
    Route::get('/{id?}', [SettingController::class, 'get']);
    Route::post('/', [SettingController::class, 'add']);
    Route::delete('/{id}', [SettingController::class, 'remove']);
    Route::post('/update-logo', [SettingController::class, 'updateLogo']);
    Route::post('/update-admin-logo', [SettingController::class, 'updateAdminLogo']);
    Route::post('/update-admin-small-logo', [SettingController::class, 'updateAdminSmallLogo']);
    Route::post('/update-app-logo', [SettingController::class, 'updateAppLogo']);
    Route::post('/update-general', [SettingController::class, 'updateGeneralSettings']);
    Route::post('/update-miscellaneous', [SettingController::class, 'updateMiscellaneous']);
    Route::post('/update-backend-theme', [SettingController::class, 'updateBackendTheme']);
    Route::post('/update-mobile-app', [SettingController::class, 'updateMobileAppSettings']);
    Route::post('/update-student-guardian', [SettingController::class, 'updateStudentGuardianSettings']);
    Route::post('/update-fees', [SettingController::class, 'updateFeesSettings']);
    Route::post('/update-id-auto-generation', [SettingController::class, 'updateIdAutoGeneration']);
    Route::post('/update-attendance', [SettingController::class, 'updateAttendanceType']);
    Route::post('/update-maintenance', [SettingController::class, 'updateMaintenance']);
    Route::post('/update-login-page-background', [SettingController::class, 'updateLoginPageBackground']);
});

// Sessions API
Route::get('/sessions/{id?}', [SessionController::class, 'get']);
Route::get('/sessions/all', [SessionController::class, 'getAllSession']);
Route::get('/sessions/pre/{session_id}', [SessionController::class, 'getPreSession']);
Route::get('/sessions/student/{student_id}', [SessionController::class, 'getStudentAcademicSession']);
Route::post('/sessions', [SessionController::class, 'add']);
Route::delete('/sessions/{id}', [SessionController::class, 'remove']);

// Notification Settings
Route::get('/notification-settings/{id?}', [NotificationSettingController::class, 'get']);
Route::post('/notification-settings', [NotificationSettingController::class, 'add']);
Route::put('/notification-settings', [NotificationSettingController::class, 'update']);
Route::put('/notification-settings/batch', [NotificationSettingController::class, 'updateBatch']);

// SMS Config
Route::get('/sms-config/{id?}', [SmsConfigController::class, 'get']);
Route::post('/sms-config', [SmsConfigController::class, 'add']);
Route::get('/sms-config/active', [SmsConfigController::class, 'getActiveSMS']);

// EmailConfigController
Route::get('/email-config', [EmailConfigController::class, 'get']);
Route::get('/email-config/type/{email_type}', [EmailConfigController::class, 'getEmailByType']);
Route::put('/email-config/update/{email_type}', [EmailConfigController::class, 'updateEmailConfig']);
Route::post('/email-config', [EmailConfigController::class, 'add']);
Route::get('/email-config/active', [EmailConfigController::class, 'getActiveEmail']);

// PaymentSettingController
Route::get('/payment-settings', [PaymentSettingController::class, 'get']);
Route::get('/payment-settings/active', [PaymentSettingController::class, 'getActiveMethod']);
Route::post('/payment-settings', [PaymentSettingController::class, 'add']);
Route::post('/payment-settings/validate', [PaymentSettingController::class, 'validPaymentSetting']);
Route::put('/payment-settings/active/{other?}', [PaymentSettingController::class, 'active']);

// FrontCmsSettingController
Route::get('/front-cms-settings/{id?}', [FrontCmsSettingController::class, 'get']);
Route::post('/front-cms-settings', [FrontCmsSettingController::class, 'add']);
Route::post('/front-cms-settings/validate', [FrontCmsSettingController::class, 'validCheckExists']);

// RoleController
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/permission/{id}', [RoleController::class, 'permission']);
Route::put('/roles/{id}', [RoleController::class, 'edit']);
Route::delete('/roles/{id}', [RoleController::class, 'delete']);

// LanguageController
Route::get('/languages/rows', [LanguageController::class, 'getRows']);
Route::get('/languages/{id?}', [LanguageController::class, 'get']);
Route::get('/languages/enabled', [LanguageController::class, 'getEnableLanguages']);
Route::delete('/languages/{id}', [LanguageController::class, 'remove']);
Route::post('/languages', [LanguageController::class, 'add']);
Route::put('/languages/staff/{id}', [LanguageController::class, 'setUserLang']);
Route::put('/languages/student/{id}', [LanguageController::class, 'setStudentLang']);
Route::put('/languages/parent/{id}', [LanguageController::class, 'setParentLang']);
Route::post('/languages/validate', [LanguageController::class, 'validCheckExists']);
Route::get('/languages/update520', [LanguageController::class, 'update520']);

// CurrencyController
Route::get('/currencies/{id?}', [CurrencyController::class, 'get']);
Route::post('/currencies', [CurrencyController::class, 'add']);
Route::put('/currencies/settings', [CurrencyController::class, 'updateCurrency']);

// UserController
Route::post('/users', [UserController::class, 'add']);
Route::post('/users/parent', [UserController::class, 'addNewParent']);
Route::post('/users/login', [UserController::class, 'checkLogin']);
Route::post('/users/login-parent', [UserController::class, 'checkLoginParent']);
Route::get('/users/information/{users_id}', [UserController::class, 'readUserInformation']);

// ModuleController
Route::get('/modules/permissions', [ModuleController::class, 'getPermission']);
Route::get('/modules/parent-permissions', [ModuleController::class, 'getParentPermission']);
Route::get('/modules/student-permissions', [ModuleController::class, 'getStudentPermission']);
Route::put('/modules/status', [ModuleController::class, 'changeStatus']);
Route::get('/modules/permission/{module_name}', [ModuleController::class, 'getPermissionByModulename']);
Route::get('/modules/{id?}', [ModuleController::class, 'get']);
Route::get('/modules/parent/{id?}', [ModuleController::class, 'getParent']);
Route::get('/modules/student/{id?}', [ModuleController::class, 'getStudent']);
Route::get('/modules/user-permissions/{role}', [ModuleController::class, 'getUserPermission']);
Route::put('/modules/parent-status', [ModuleController::class, 'changeParentStatus']);
Route::put('/modules/student-status', [ModuleController::class, 'changeStudentStatus']);
Route::get('/modules/has/{module_shortcode}', [ModuleController::class, 'hasModule']);
Route::get('/module-permissions/{id?}', [ModuleController::class, 'getModulePermissions']);

// CustomFieldController
Route::get('/custom-fields/{id?}', [CustomFieldController::class, 'get']);
Route::delete('/custom-fields/{id}', [CustomFieldController::class, 'remove']);
Route::post('/custom-fields', [CustomFieldController::class, 'add']);
Route::put('/custom-fields/order', [CustomFieldController::class, 'updateOrder']);
Route::get('/custom-fields/belong/{belong_to}', [CustomFieldController::class, 'getByBelong']);
Route::post('/custom-fields/insert', [CustomFieldController::class, 'insertRecord']);
Route::put('/custom-fields/update', [CustomFieldController::class, 'updateRecord']);
Route::get('/custom-fields/custom/{belongs_to}/{display_table?}', [CustomFieldController::class, 'getCustomFields']);
Route::post('/custom-fields/online-admission/insert', [CustomFieldController::class, 'onlineAdmissionInsertRecord']);
Route::put('/custom-fields/online-admission/update', [CustomFieldController::class, 'onlineAdmissionUpdateRecord']);

// CaptchaController
Route::get('/captcha/settings', [CaptchaController::class, 'getSetting']);
Route::get('/captcha/status/{name}', [CaptchaController::class, 'getStatus']);
Route::put('/captcha/status', [CaptchaController::class, 'updateStatus']);

// SystemFieldController
Route::get('/system-fields', [SystemFieldController::class, 'index']);
Route::put('/system-fields/status', [SystemFieldController::class, 'changeStatus']);

// FiletypeController
Route::get('/filetypes/{id?}', [FiletypeController::class, 'get']);
Route::post('/filetypes', [FiletypeController::class, 'add']);

// SidebarmenuController
Route::get('/sidebar-menus/{id?}', [SidebarmenuController::class, 'get']);
Route::delete('/sidebar-menus/{id}', [SidebarmenuController::class, 'remove']);
Route::post('/sidebar-menus', [SidebarmenuController::class, 'add']);
Route::post('/sidebar-sub-menus', [SidebarmenuController::class, 'addSubMenu']);
Route::get('/sidebar-menus/with-submenus/{sidebar_display?}', [SidebarmenuController::class, 'getMenuwithSubmenus']);
Route::get('/sidebar-sub-menus/menu/{menu_id}/{sidebar_display?}', [SidebarmenuController::class, 'getSubmenusByMenuId']);
Route::get('/sidebar-sub-menus/{id}', [SidebarmenuController::class, 'getSubmenuById']);
Route::put('/sidebar-menus/order', [SidebarmenuController::class, 'updateMenuOrder']);
Route::put('/sidebar-sub-menus/order', [SidebarmenuController::class, 'updateSubmenuOrder']);
Route::put('/sidebar-sub-menus/key', [SidebarmenuController::class, 'updateSubmenuByKey']);

// UpdaterController
Route::get('/updater/{chk?}', [UpdaterController::class, 'index']);
Route::post('/updater', [UpdaterController::class, 'store']);

// WhatsappConfigController
Route::get('/whatsapp-configs', [WhatsappConfigController::class, 'index'])->name('admin.whatsapp.index');
Route::post('/whatsapp-configs/update', [WhatsappConfigController::class, 'whatsapp'])->name('admin.whatsapp');

// CertificateController
Route::get('/certificates', [CertificateController::class, 'index'])->name('admin.certificate.index');
Route::post('/certificates/create', [CertificateController::class, 'create'])->name('admin.certificate.create');
Route::post('/certificates/edit/{id}', [CertificateController::class, 'edit'])->name('admin.certificate.edit');
Route::delete('/certificates/delete/{id}', [CertificateController::class, 'delete'])->name('admin.certificate.delete');
Route::get('/certificates/view/{id}', [CertificateController::class, 'viewCertificate'])->name('admin.certificate.view');
Route::get('/certificates/preview/{id}', [CertificateController::class, 'previewCertificate'])->name('admin.certificate.preview');

// BackupController
Route::match(['get', 'post'], '/backup', [BackupController::class, 'backup'])->name('admin.backup');
Route::get('/downloadbackup/{filename}', [BackupController::class, 'download'])->name('admin.backup.download');
Route::delete('/dropbackup/{filename}', [BackupController::class, 'delete'])->name('admin.backup.delete');


// EnquiryController
Route::prefix('enquiry')->group(function () {
    Route::get('/', [EnquiryController::class, 'index'])->name('enquiry.index');
    Route::post('/', [EnquiryController::class, 'store'])->name('enquiry.store');
    Route::get('/{id}', [EnquiryController::class, 'show'])->name('enquiry.show');
    Route::put('/{id}', [EnquiryController::class, 'update'])->name('enquiry.update');
    Route::delete('/{id}', [EnquiryController::class, 'destroy'])->name('enquiry.destroy');
    Route::post('/{enquiryId}/follow-up', [EnquiryController::class, 'followUp'])->name('enquiry.follow-up.store');
    Route::get('/{enquiryId}/follow-ups', [EnquiryController::class, 'getFollowUps'])->name('enquiry.follow-ups');
    Route::delete('/{enquiryId}/follow-up/{followUpId}', [EnquiryController::class, 'deleteFollowUp'])->name('enquiry.follow-up.delete');
    Route::put('/{id}/status', [EnquiryController::class, 'changeStatus'])->name('enquiry.status');
    Route::get('/classes', [EnquiryController::class, 'getClasses'])->name('enquiry.classes');
    Route::get('/sources', [EnquiryController::class, 'getSources'])->name('enquiry.sources');
    Route::get('/references', [EnquiryController::class, 'getReferences'])->name('enquiry.references');
});

// VisitorsController
Route::prefix('visitors')->group(function () {
    Route::get('/', [VisitorsController::class, 'index']);
    Route::post('/', [VisitorsController::class, 'store']);
    Route::get('/{id}', [VisitorsController::class, 'show']);
    Route::put('/{id}', [VisitorsController::class, 'update']);
    Route::delete('/{id}', [VisitorsController::class, 'destroy']);
    Route::get('/purposes', [VisitorsController::class, 'getPurposes']);
});

// GeneralCallController
Route::prefix('general-calls')->group(function () {
    Route::get('/', [GeneralCallController::class, 'index']);
    Route::post('/', [GeneralCallController::class, 'store']);
    Route::get('/{id}', [GeneralCallController::class, 'show']);
    Route::put('/{id}', [GeneralCallController::class, 'update']);
    Route::delete('/{id}', [GeneralCallController::class, 'destroy']);
    Route::get('/list', [GeneralCallController::class, 'getCallList']); // DataTables endpoint
});

// DispatchController
Route::prefix('dispatch')->group(function () {
    Route::get('/', [DispatchController::class, 'index']); // ?type=dispatch or ?type=receive
    Route::post('/', [DispatchController::class, 'store']);
    Route::get('/{id}', [DispatchController::class, 'show']);
    Route::put('/{id}', [DispatchController::class, 'update']);
    Route::delete('/{id}', [DispatchController::class, 'destroy']);
    Route::get('/download/{id}', [DispatchController::class, 'download']);
});

// ComplaintController
Route::prefix('complaints')->group(function () {
    Route::get('/', [ComplaintController::class, 'index']);
    Route::post('/', [ComplaintController::class, 'store']);
    Route::get('/{id}', [ComplaintController::class, 'show']);
    Route::put('/{id}', [ComplaintController::class, 'update']);
    Route::delete('/{id}', [ComplaintController::class, 'destroy']);
    Route::get('/types', [ComplaintController::class, 'getComplaintTypes']);
    Route::get('/sources', [ComplaintController::class, 'getComplaintSources']);
    Route::get('/download/{id}', [ComplaintController::class, 'download']);
});

// VisitorsPurposeController
Route::prefix('visitors-purposes')->group(function () {
    Route::get('/', [VisitorsPurposeController::class, 'index']);
    Route::post('/', [VisitorsPurposeController::class, 'store']);
    Route::get('/{id}', [VisitorsPurposeController::class, 'show']);
    Route::put('/{id}', [VisitorsPurposeController::class, 'update']);
    Route::delete('/{id}', [VisitorsPurposeController::class, 'destroy']);
});

// ComplaintTypeController
Route::prefix('complaint-types')->group(function () {
    Route::get('/', [ComplaintTypeController::class, 'index']);
    Route::post('/', [ComplaintTypeController::class, 'store']);
    Route::get('/{id}', [ComplaintTypeController::class, 'show']);
    Route::put('/{id}', [ComplaintTypeController::class, 'update']);
    Route::delete('/{id}', [ComplaintTypeController::class, 'destroy']);
});


// SourceController
Route::prefix('sources')->group(function () {
    Route::get('/', [SourceController::class, 'index']);
    Route::post('/', [SourceController::class, 'store']);
    Route::get('/{id}', [SourceController::class, 'show']);
    Route::put('/{id}', [SourceController::class, 'update']);
    Route::delete('/{id}', [SourceController::class, 'destroy']);
});


// ReferenceController
Route::prefix('references')->group(function () {
    Route::get('/', [ReferenceController::class, 'index']);
    Route::post('/', [ReferenceController::class, 'store']);
    Route::get('/{id}', [ReferenceController::class, 'show']);
    Route::put('/{id}', [ReferenceController::class, 'update']);
    Route::delete('/{id}', [ReferenceController::class, 'destroy']);
});

// ExamGroupController
Route::group(['prefix' => 'exam-groups'], function () {
    Route::get('/', [ExamGroupController::class, 'index']);
    Route::post('/', [ExamGroupController::class, 'store']);
    Route::get('/{id}', [ExamGroupController::class, 'show']);
    Route::put('/{id}', [ExamGroupController::class, 'update']);
    Route::delete('/{id}', [ExamGroupController::class, 'destroy']);
});

Route::prefix('exam-pattern')->group(function () {
    Route::get('/export-format', [ExamPatternController::class, 'exportFormat']);
    Route::post('/upload-file', [ExamPatternController::class, 'uploadFile']);
    Route::match(['get', 'post'], '/', [ExamPatternController::class, 'index']);
    Route::get('/exams', [ExamPatternController::class, 'getExamByExamGroup']);
    Route::delete('/exam/{id}', [ExamPatternController::class, 'deleteExam']);
    Route::get('/exam/{id}', [ExamPatternController::class, 'exam']);
    Route::match(['get', 'post'], '/exam-result/{id}', [ExamPatternController::class, 'examResult']);
    Route::match(['get', 'post'], '/add-mark/{id}', [ExamPatternController::class, 'addMark']);
    Route::delete('/{id}', [ExamPatternController::class, 'delete']);
    Route::match(['get', 'post'], '/edit/{id}', [ExamPatternController::class, 'edit']);
    Route::get('/by-class-section', [ExamPatternController::class, 'getByClassSection']);
    Route::get('/add-exam/{id}', [ExamPatternController::class, 'addExam']);
    Route::get('/not-applied-discount/{student_session_id}', [ExamPatternController::class, 'getNotAppliedDiscount']);
    Route::post('/subject-student', [ExamPatternController::class, 'subjectStudent']);
    Route::post('/exam-student', [ExamPatternController::class, 'examStudent']);
    Route::post('/ajax-add-exam', [ExamPatternController::class, 'ajaxAddExam']);
    Route::get('/exams-by-group', [ExamPatternController::class, 'getExamsByExamGroup']);
    Route::post('/entry-marks', [ExamPatternController::class, 'entryMarks']);
    Route::get('/exam-list', [ExamPatternController::class, 'getExam']);
    Route::get('/connect-exams', [ExamPatternController::class, 'connectExams']);
    Route::get('/exam-by-id', [ExamPatternController::class, 'getExamById']);
    Route::get('/exam-subjects', [ExamPatternController::class, 'getExamSubjects']);
    Route::get('/subject-by-exam', [ExamPatternController::class, 'getSubjectByExam']);
    Route::get('/teacher-remark', [ExamPatternController::class, 'getTeacherRemarkByExam']);
    Route::post('/add-exam-subject', [ExamPatternController::class, 'addExamSubject']);
    Route::match(['get', 'post'], '/assign/{id}', [ExamPatternController::class, 'assign']);
    Route::post('/add-student', [ExamPatternController::class, 'addStudent']);
    Route::post('/ajax-connect', [ExamPatternController::class, 'ajaxConnectForm']);
    Route::get('/exam-group-by-class-section', [ExamPatternController::class, 'getExamGroupByClassSection']);
    Route::post('/entry-students', [ExamPatternController::class, 'entryStudents']);
    Route::post('/save-exam-remark', [ExamPatternController::class, 'saveExamRemark']);
    Route::match(['get', 'post'], '/marks-distribution-type', [ExamPatternController::class, 'marksDistributionType']);
    Route::match(['get', 'post'], '/marks-distribution-type/edit/{id}', [ExamPatternController::class, 'editMarksDistributionType']);
    Route::delete('/marks-distribution-type/{id}', [ExamPatternController::class, 'deleteMarksDistributionType']);
    Route::match(['get', 'post'], '/marks-distribution-component', [ExamPatternController::class, 'marksDistributionComponent']);
    Route::match(['get', 'post'], '/marks-distribution-component/edit/{id}', [ExamPatternController::class, 'editMarksDistributionComponent']);
    Route::delete('/marks-distribution-component/{id}', [ExamPatternController::class, 'deleteMarksDistributionComponent']);
    Route::match(['get', 'post'], '/subjectwise-remark', [ExamPatternController::class, 'subjectwiseRemark']);
    Route::match(['get', 'post'], '/subjectwise-remark/edit/{id}', [ExamPatternController::class, 'editSubjectwiseRemark']);
    Route::delete('/subjectwise-remark/{id}', [ExamPatternController::class, 'deleteSubjectwiseRemark']);
    Route::match(['get', 'post'], '/classwise-subject-mark', [ExamPatternController::class, 'classwiseSubjectMark']);
    Route::match(['get', 'post'], '/classwise-subject-mark/edit/{id}', [ExamPatternController::class, 'editClasswiseSubjectMark']);
    Route::get('/subjects-by-class', [ExamPatternController::class, 'getSubjectByClass']);
    Route::delete('/classwise-subject-mark/{id}', [ExamPatternController::class, 'deleteClasswiseSubjectMark']);
    Route::match(['get', 'post'], '/class-subject-component', [ExamPatternController::class, 'classSubjectComponent']);
    Route::get('/class-subject-marks', [ExamPatternController::class, 'getClassSubjectMarks']);
    Route::match(['get', 'post'], '/class-subject-component/edit/{id}', [ExamPatternController::class, 'editClassSubjectComponent']);
    Route::delete('/class-subject-component/{id}', [ExamPatternController::class, 'deleteClassSubjectComponent']);
    Route::match(['get', 'post'], '/scorecard-component', [ExamPatternController::class, 'scorecardComponent']);
    Route::match(['get', 'post'], '/scorecard-component/edit/{id}', [ExamPatternController::class, 'editScorecardComponent']);
    Route::delete('/scorecard-component/{id}', [ExamPatternController::class, 'deleteScorecardComponent']);
});