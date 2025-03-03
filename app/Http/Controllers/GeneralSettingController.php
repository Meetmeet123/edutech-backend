<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

class GeneralSettingController extends Controller
{
    public function index()
    {
        try {
            $settings = GeneralSetting::first();
            if (!$settings) {
                $settings = GeneralSetting::create([
                    'school_name' => 'Default School',
                    'address' => 'Default Address',
                    'phone' => '0000000000',
                    'email' => 'default@school.com',
                    'session_id' => 1,
                    'start_month' => 'January',
                    'date_format' => 'd/m/Y',
                    'timezone' => 'UTC',
                    'start_week' => 'Monday',
                    'currency_format' => '$0.00',
                    'base_url' => 'http://example.com',
                    'folder_path' => '/uploads',
                    'theme' => 'default.jpg',
                    'student_panel_login' => false,
                    'parent_panel_login' => false,
                    'student_login_options' => json_encode(['admission_no']),
                    'parent_login_options' => json_encode(['mobile_number']),
                    'student_timeline' => 'disabled',
                    'is_offline_fee_payment' => false,
                    'offline_bank_payment_instruction' => '',
                    'is_student_feature_lock' => false,
                    'lock_grace_period' => null,
                    'duplicate_fees_invoice' => json_encode([0, 1, 2]),
                    'fee_due_days' => 0,
                    'single_page_print' => false,
                    'collect_back_date_fees' => false,
                    'adm_auto_insert' => false,
                    'adm_prefix' => 'ADM',
                    'adm_no_digit' => 5,
                    'adm_start_from' => 1,
                    'staffid_auto_insert' => false,
                    'staffid_prefix' => 'STF',
                    'staffid_no_digit' => 5,
                    'staffid_start_from' => 1,
                    'attendence_type' => false,
                    'biometric' => false,
                    'biometric_device' => '',
                    'low_attendance_limit' => 75,
                    'maintenance_mode' => false,
                    'my_question' => false,
                    'scan_code_type' => 'barcode',
                    'exam_result' => false,
                    'class_teacher' => 'no',
                    'superadmin_restriction' => 'disabled',
                    'event_reminder' => 'disabled',
                    'calendar_event_reminder' => null,
                    'staff_notification_email' => null,
                ]);
            }

            $settings->print_logo = $settings->print_logo
                ? Storage::url('logos/print/' . $settings->print_logo)
                : Storage::url('logos/default/images.png');
            $settings->admin_logo = $settings->admin_logo
                ? Storage::url('logos/admin/' . $settings->admin_logo)
                : Storage::url('logos/default/images.png');
            $settings->admin_small_logo = $settings->admin_small_logo
                ? Storage::url('logos/admin_small/' . $settings->admin_small_logo)
                : Storage::url('logos/default/images.png');
            $settings->app_logo = $settings->app_logo
                ? Storage::url('logos/app/' . $settings->app_logo)
                : Storage::url('logos/default/images.png');
            $settings->admin_login_page_background = $settings->admin_login_page_background
                ? Storage::url('login_images/' . $settings->admin_login_page_background)
                : Storage::url('logos/default/images.png');
            $settings->user_login_page_background = $settings->user_login_page_background
                ? Storage::url('login_images/' . $settings->user_login_page_background)
                : Storage::url('logos/default/images.png');
            $settings->theme = $settings->theme
                ? Storage::url('backend/images/' . $settings->theme)
                : Storage::url('backend/images/default.jpg');

            return response()->json($settings, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to fetch or create settings'], 500);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'school_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'session_id' => 'nullable|string|max:50',
            'start_month' => 'nullable|string|in:April,January,July,September',
            'date_format' => 'nullable|string',
            'timezone' => 'nullable|string',
            'start_week' => 'nullable|string|in:Monday,Sunday',
            'currency_format' => 'nullable|string',
            'base_url' => 'nullable|string',
            'folder_path' => 'nullable|string',
            'school_code' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::updateOrCreate(
            ['id' => 1],
            $request->only([
                'school_name',
                'school_code',
                'address',
                'phone',
                'email',
                'session_id',
                'start_month',
                'date_format',
                'timezone',
                'start_week',
                'currency_format',
                'base_url',
                'folder_path',
            ])
        );

        return response()->json(['message' => 'Settings saved successfully', 'data' => $settings], 200);
    }

    public function uploadLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo_type' => 'required|in:print_logo,admin_logo,admin_small_logo,app_logo,admin_login_page_background,user_login_page_background',
            'file' => 'required|image|mimes:jpeg,png,jpg|max:50000',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
            ]
        );

        $file = $request->file('file');
        $logoType = $request->input('logo_type');
        $path = match ($logoType) {
            'print_logo' => 'logos/print',
            'admin_logo' => 'logos/admin',
            'admin_small_logo' => 'logos/admin_small',
            'app_logo' => 'logos/app',
            'admin_login_page_background' => 'login_images',
            'user_login_page_background' => 'login_images',
        };

        try {
            if ($settings->$logoType && Storage::exists('public/' . $path . '/' . $settings->$logoType)) {
                Storage::delete('public/' . $path . '/' . $settings->$logoType);
            }

            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/' . $path, $filename);

            $settings->$logoType = $filename;
            $settings->save();

            return response()->json([
                'message' => ucfirst(str_replace('_', ' ', $logoType)) . ' uploaded successfully',
                'url' => Storage::url($path . '/' . $filename)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to upload image'], 500);
        }
    }

    public function updateTheme(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'theme' => 'required|in:white.jpg,default.jpg,red.jpg,blue.jpg,gray.jpg',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
            ]
        );

        try {
            $settings->theme = $request->input('theme');
            $settings->save();

            return response()->json([
                'message' => 'Theme updated successfully',
                'theme' => Storage::url('backend/images/' . $settings->theme)
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update theme'], 500);
        }
    }

    public function updateMobileAppSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'mobile_api_url' => 'nullable|url',
            'app_primary_color_code' => 'nullable|string|max:7',
            'app_secondary_color_code' => 'nullable|string|max:7',
            'admin_mobile_api_url' => 'nullable|url',
            'admin_app_primary_color_code' => 'nullable|string|max:7',
            'admin_app_secondary_color_code' => 'nullable|string|max:7',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
            ]
        );

        try {
            $settings->update($request->only([
                'mobile_api_url',
                'app_primary_color_code',
                'app_secondary_color_code',
                'admin_mobile_api_url',
                'admin_app_primary_color_code',
                'admin_app_secondary_color_code'
            ]));

            return response()->json([
                'message' => 'Mobile app settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update mobile app settings'], 500);
        }
    }

    public function registerAndroidApp(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'envato_purchase_code' => 'required|string|max:255',
            'envato_email' => 'required|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
            ]
        );

        try {
            if ($settings->envato_purchase_code) {
                return response()->json(['message' => 'Android app purchase code already registered'], 400);
            }

            $settings->envato_purchase_code = $request->input('envato_purchase_code');
            $settings->envato_email = $request->input('envato_email');
            $settings->save();

            return response()->json(['message' => 'Android app registered successfully'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to register Android app'], 500);
        }
    }

    public function updateStudentGuardianSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'student_panel_login' => 'boolean',
            'parent_panel_login' => 'boolean',
            'student_login_options' => 'array',
            'student_login_options.*' => 'in:admission_no,mobile_number,email',
            'parent_login_options' => 'array',
            'parent_login_options.*' => 'in:mobile_number,email',
            'student_timeline' => 'required|in:enabled,disabled',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
                'student_panel_login' => false,
                'parent_panel_login' => false,
                'student_login_options' => json_encode(['admission_no']),
                'parent_login_options' => json_encode(['mobile_number']),
                'student_timeline' => 'disabled',
            ]
        );

        try {
            $settings->student_panel_login = $request->boolean('student_panel_login', false);
            $settings->parent_panel_login = $request->boolean('parent_panel_login', false);
            $settings->student_login_options = $request->input('student_login_options', []);
            $settings->parent_login_options = $request->input('parent_login_options', []);
            $settings->student_timeline = $request->input('student_timeline');

            $settings->save();

            return response()->json([
                'message' => 'Student and guardian settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update student and guardian settings'], 500);
        }
    }

    public function updateFeeSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'is_offline_fee_payment' => 'boolean',
            'offline_bank_payment_instruction' => 'nullable|string',
            'is_student_feature_lock' => 'boolean',
            'lock_grace_period' => 'nullable|integer|min:0',
            'duplicate_fees_invoice' => 'array',
            'duplicate_fees_invoice.*' => 'in:0,1,2',
            'fee_due_days' => 'required|integer|min:0',
            'single_page_print' => 'boolean',
            'collect_back_date_fees' => 'boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
                'is_offline_fee_payment' => false,
                'offline_bank_payment_instruction' => '',
                'is_student_feature_lock' => false,
                'lock_grace_period' => null,
                'duplicate_fees_invoice' => json_encode([0, 1, 2]),
                'fee_due_days' => 0,
                'single_page_print' => false,
                'collect_back_date_fees' => false,
            ]
        );

        try {
            $settings->is_offline_fee_payment = $request->boolean('is_offline_fee_payment', false);
            $settings->offline_bank_payment_instruction = $request->input('offline_bank_payment_instruction');
            $settings->is_student_feature_lock = $request->boolean('is_student_feature_lock', false);
            $settings->lock_grace_period = $request->input('is_student_feature_lock') ? $request->input('lock_grace_period') : null;
            $settings->duplicate_fees_invoice = $request->input('duplicate_fees_invoice', []);
            $settings->fee_due_days = $request->input('fee_due_days');
            $settings->single_page_print = $request->boolean('single_page_print', false);
            $settings->collect_back_date_fees = $request->boolean('collect_back_date_fees', false);

            $settings->save();

            return response()->json([
                'message' => 'Fee settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update fee settings'], 500);
        }
    }

    public function updateIdAutoGenerationSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'adm_auto_insert' => 'boolean',
            'adm_prefix' => 'required|string|max:10',
            'adm_no_digit' => 'required|integer|min:1|max:10',
            'adm_start_from' => 'required|integer|min:1',
            'staffid_auto_insert' => 'boolean',
            'staffid_prefix' => 'required|string|max:10',
            'staffid_no_digit' => 'required|integer|min:1|max:10',
            'staffid_start_from' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
                'adm_auto_insert' => false,
                'adm_prefix' => 'ADM',
                'adm_no_digit' => 5,
                'adm_start_from' => 1,
                'staffid_auto_insert' => false,
                'staffid_prefix' => 'STF',
                'staffid_no_digit' => 5,
                'staffid_start_from' => 1,
            ]
        );

        try {
            $settings->adm_auto_insert = $request->boolean('adm_auto_insert', false);
            $settings->adm_prefix = $request->input('adm_prefix');
            $settings->adm_no_digit = $request->input('adm_no_digit');
            $settings->adm_start_from = $request->input('adm_start_from');
            $settings->staffid_auto_insert = $request->boolean('staffid_auto_insert', false);
            $settings->staffid_prefix = $request->input('staffid_prefix');
            $settings->staffid_no_digit = $request->input('staffid_no_digit');
            $settings->staffid_start_from = $request->input('staffid_start_from');

            $settings->save();

            return response()->json([
                'message' => 'ID auto-generation settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update ID auto-generation settings'], 500);
        }
    }

    public function updateAttendanceTypeSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendence_type' => 'boolean',
            'biometric' => 'boolean',
            'biometric_device' => 'nullable|string',
            'low_attendance_limit' => 'nullable|integer|min:0|max:100',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'attendence_type' => false,
                'biometric' => false,
                'biometric_device' => '',
                'low_attendance_limit' => 75,
            ]
        );

        try {
            $settings->attendence_type = $request->boolean('attendence_type', false);
            $settings->biometric = $request->boolean('biometric', false);
            $settings->biometric_device = $request->input('biometric_device');
            $settings->low_attendance_limit = $request->input('low_attendance_limit');

            $settings->save();

            return response()->json([
                'message' => 'Attendance type settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update attendance type settings'], 500);
        }
    }

    public function updateMaintenanceMode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'maintenance_mode' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
                'maintenance_mode' => false,
            ]
        );

        try {
            $settings->maintenance_mode = $request->boolean('maintenance_mode');
            $settings->save();

            return response()->json([
                'message' => 'Maintenance mode updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update maintenance mode'], 500);
        }
    }

    public function updateMiscellaneousSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'my_question' => 'boolean',
            'scan_code_type' => 'required|in:barcode,qrcode',
            'exam_result' => 'boolean',
            'class_teacher' => 'required|in:no,yes',
            'superadmin_restriction' => 'required|in:disabled,enabled',
            'event_reminder' => 'required|in:disabled,enabled',
            'calendar_event_reminder' => 'nullable|integer|min:0',
            'staff_notification_email' => 'nullable|email|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $settings = GeneralSetting::firstOrCreate(
            ['id' => 1],
            [
                'school_name' => 'Default School',
                'address' => 'Default Address',
                'phone' => '0000000000',
                'email' => 'default@school.com',
                'session_id' => 1,
                'start_month' => 'January',
                'date_format' => 'd/m/Y',
                'timezone' => 'UTC',
                'start_week' => 'Monday',
                'currency_format' => '$0.00',
                'base_url' => 'http://example.com',
                'folder_path' => '/uploads',
                'theme' => 'default.jpg',
                'my_question' => false,
                'scan_code_type' => 'barcode',
                'exam_result' => false,
                'class_teacher' => 'no',
                'superadmin_restriction' => 'disabled',
                'event_reminder' => 'disabled',
                'calendar_event_reminder' => null,
                'staff_notification_email' => null,
            ]
        );

        try {
            $settings->my_question = $request->boolean('my_question', false);
            $settings->scan_code_type = $request->input('scan_code_type');
            $settings->exam_result = $request->boolean('exam_result', false);
            $settings->class_teacher = $request->input('class_teacher');
            $settings->superadmin_restriction = $request->input('superadmin_restriction');
            $settings->event_reminder = $request->input('event_reminder');
            $settings->calendar_event_reminder = $request->input('event_reminder') === 'enabled' ? $request->input('calendar_event_reminder') : null;
            $settings->staff_notification_email = $request->input('staff_notification_email');

            $settings->save();

            return response()->json([
                'message' => 'Miscellaneous settings updated successfully',
                'data' => $settings
            ], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to update miscellaneous settings'], 500);
        }
    }
}