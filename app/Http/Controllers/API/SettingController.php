<?php
namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\SchSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class SettingController extends Controller
{
    // Original methods
    public function getMysqlVersion()
    {
        $mysqlVersion = DB::select('SELECT VERSION() as version')[0];
        return response()->json(['data' => $mysqlVersion], 200);
    }

    public function getSqlMode()
    {
        $sqlMode = DB::select('SELECT @@sql_mode as mode')[0];
        return response()->json(['data' => $sqlMode], 200);
    }

    public function get($id = null)
    {
        $query = SchSetting::select(
            'sch_settings.lastname', 'sch_settings.middlename', 'sch_settings.id', 'sch_settings.lang_id',
            'sch_settings.languages', 'sch_settings.class_teacher', 'sch_settings.cron_secret_key',
            'sch_settings.timezone', 'sch_settings.superadmin_restriction', 'sch_settings.student_timeline',
            'sch_settings.name', 'sch_settings.email', 'sch_settings.biometric', 'sch_settings.biometric_device',
            'sch_settings.time_format', 'sch_settings.phone', 'languages.language', 'sch_settings.attendence_type',
            'sch_settings.address', 'sch_settings.dise_code', 'sch_settings.date_format', 'sch_settings.currency',
            'sch_settings.currency_place', 'sch_settings.start_month', 'sch_settings.start_week',
            'sch_settings.session_id', 'sch_settings.fee_due_days', 'sch_settings.image', 'sch_settings.theme',
            'sessions.session', 'sch_settings.online_admission', 'sch_settings.is_duplicate_fees_invoice',
            'sch_settings.is_student_house', 'sch_settings.is_blood_group', 'sch_settings.admin_logo',
            'sch_settings.admin_small_logo', 'sch_settings.mobile_api_url', 'sch_settings.app_primary_color_code',
            'sch_settings.app_secondary_color_code', 'sch_settings.app_logo', 'sch_settings.student_profile_edit',
            'sch_settings.staff_barcode', 'sch_settings.student_barcode', 'languages.is_rtl',
            'sch_settings.student_panel_login', 'sch_settings.parent_panel_login', 'sch_settings.currency_format',
            'sch_settings.exam_result', 'sch_settings.base_url', 'sch_settings.folder_path', 'currencies.symbol as currency_symbol',
            'currencies.base_price', 'currencies.short_name as currency', 'currencies.id as currency_id',
            'sch_settings.admin_login_page_background', 'sch_settings.user_login_page_background',
            'sch_settings.low_attendance_limit'
        )
            ->leftJoin('sessions', 'sessions.id', '=', 'sch_settings.session_id')
            ->leftJoin('languages', 'languages.id', '=', 'sch_settings.lang_id')
            ->leftJoin('currencies', 'currencies.id', '=', 'sch_settings.currency');

        if ($id) {
            $query->where('sch_settings.id', $id);
            $result = $query->first();
            return response()->json(['data' => $result ? $result : null], 200);
        } else {
            $result = $query->orderBy('sch_settings.id')->get()->toArray();
            if (!empty($result)) {
                $result[0]['current_session'] = [
                    'session_id' => $result[0]['session_id'],
                    'session' => $result[0]['session']
                ];
            }
            return response()->json(['data' => $result], 200);
        }
    }

    public function add(Request $request)
    {
        try {
            DB::beginTransaction();
            $data = $request->all();
            if (isset($data['id'])) {
                $setting = SchSetting::find($data['id']);
                if ($setting) {
                    $setting->update($data);
                    $message = "Updated settings with id " . $data['id'];
                }
            } else {
                $setting = SchSetting::create($data);
                $message = "Inserted settings with id " . $setting->id;
            }
            DB::commit();
            return response()->json(['message' => $message, 'data' => $setting], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function remove($id)
    {
        try {
            DB::beginTransaction();
            $setting = SchSetting::find($id);
            if ($setting) {
                $setting->delete();
                $message = "Deleted settings with id " . $id;
                DB::commit();
                return response()->json(['message' => $message], 200);
            }
            return response()->json(['message' => 'Setting not found'], 404);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    // Logo-related methods
    public function updateLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'image' => 'required|image|mimes:jpg,jpeg,png|max:1024' // Max 1MB
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            if ($setting->image && Storage::exists('public/uploads/school_content/logo/' . $setting->image)) {
                Storage::delete('public/uploads/school_content/logo/' . $setting->image);
            }

            $file = $request->file('image');
            $fileName = $setting->id . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/school_content/logo', $fileName);

            $setting->update(['image' => $fileName]);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Logo updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateAdminLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'admin_logo' => 'required|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            if ($setting->admin_logo && Storage::exists('public/uploads/school_content/admin_logo/' . $setting->admin_logo)) {
                Storage::delete('public/uploads/school_content/admin_logo/' . $setting->admin_logo);
            }

            $file = $request->file('admin_logo');
            $fileName = $setting->id . '_admin.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/school_content/admin_logo', $fileName);

            $setting->update(['admin_logo' => $fileName]);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Admin logo updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateAdminSmallLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'admin_small_logo' => 'required|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            if ($setting->admin_small_logo && Storage::exists('public/uploads/school_content/admin_small_logo/' . $setting->admin_small_logo)) {
                Storage::delete('public/uploads/school_content/admin_small_logo/' . $setting->admin_small_logo);
            }

            $file = $request->file('admin_small_logo');
            $fileName = $setting->id . '_admin_small.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/school_content/admin_small_logo', $fileName);

            $setting->update(['admin_small_logo' => $fileName]);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Admin small logo updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateAppLogo(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'app_logo' => 'required|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'errors' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            if ($setting->app_logo && Storage::exists('public/uploads/school_content/logo/app_logo/' . $setting->app_logo)) {
                Storage::delete('public/uploads/school_content/logo/app_logo/' . $setting->app_logo);
            }

            $file = $request->file('app_logo');
            $fileName = $setting->id . '_app.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/school_content/logo/app_logo', $fileName);

            $setting->update(['app_logo' => $fileName]);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'App logo updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateGeneralSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'session_id' => 'required|integer',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'start_month' => 'required|integer|between:1,12',
            'start_week' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|email',
            'timezone' => 'required|string',
            'date_format' => 'required|string',
            'currency_format' => 'required|string',
            'currency_place' => 'required|string',
            'base_url' => 'required|url',
            'folder_path' => 'required|string',
            'dise_code' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $setting->update($request->only([
                'session_id', 'name', 'phone', 'start_month', 'start_week', 'address',
                'email', 'timezone', 'date_format', 'currency_format', 'currency_place',
                'base_url', 'folder_path', 'dise_code'
            ]));
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'General settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateMiscellaneous(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'my_question' => 'nullable|string',
            'exam_result' => 'nullable|string',
            'class_teacher' => 'nullable|string',
            'superadmin_restriction' => 'nullable|string',
            'event_reminder' => 'required|in:enabled,disabled',
            'calendar_event_reminder' => 'required_if:event_reminder,enabled|integer',
            'staff_notification_email' => 'nullable|email',
            'scan_code_type' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $data = $request->only([
                'my_question', 'exam_result', 'class_teacher', 'superadmin_restriction',
                'event_reminder', 'staff_notification_email', 'scan_code_type'
            ]);
            $data['calendar_event_reminder'] = $request->event_reminder === 'enabled' ? $request->calendar_event_reminder : 0;

            $setting->update($data);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Miscellaneous settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateBackendTheme(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'theme' => 'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $setting->update(['theme' => $request->theme]);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Theme updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateMobileAppSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'mobile_api_url' => 'required|url',
            'app_primary_color_code' => 'required|string|max:7',
            'app_secondary_color_code' => 'required|string|max:7',
            'admin_app_primary_color_code' => 'nullable|string|max:7',
            'admin_app_secondary_color_code' => 'nullable|string|max:7',
            'admin_mobile_api_url' => 'nullable|url'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $setting->update($request->only([
                'mobile_api_url', 'app_primary_color_code', 'app_secondary_color_code',
                'admin_app_primary_color_code', 'admin_app_secondary_color_code', 'admin_mobile_api_url'
            ]));
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Mobile app settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateStudentGuardianSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'student_timeline' => 'nullable|string',
            'student_login' => 'nullable|array',
            'parent_login' => 'nullable|array',
            'student_panel_login' => 'required|boolean',
            'parent_panel_login' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $data = $request->only([
                'student_timeline', 'student_panel_login', 'parent_panel_login'
            ]);
            $data['student_login'] = json_encode($request->student_login ?? []);
            $data['parent_login'] = json_encode($request->parent_login ?? []);

            $setting->update($data);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Student/Guardian settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateFeesSettings(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'is_student_feature_lock' => 'required|boolean',
            'is_offline_fee_payment' => 'required|boolean',
            'is_duplicate_fees_invoice' => 'required|array',
            'lock_grace_period' => 'required|integer',
            'fee_due_days' => 'required|integer',
            'single_page_print' => 'required|boolean',
            'collect_back_date_fees' => 'nullable|boolean',
            'offline_bank_payment_instruction' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $data = $request->only([
                'is_student_feature_lock', 'is_offline_fee_payment', 'lock_grace_period',
                'fee_due_days', 'single_page_print', 'collect_back_date_fees',
                'offline_bank_payment_instruction'
            ]);
            $data['is_duplicate_fees_invoice'] = implode(',', $request->is_duplicate_fees_invoice);

            $setting->update($data);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Fee settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateIdAutoGeneration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'adm_auto_insert' => 'required|boolean',
            'adm_prefix' => 'required_if:adm_auto_insert,1|string',
            'adm_start_from' => 'required_if:adm_auto_insert,1|integer',
            'adm_no_digit' => 'required_if:adm_auto_insert,1|integer|check_admission_digit',
            'staffid_auto_insert' => 'required|boolean',
            'staffid_prefix' => 'required_if:staffid_auto_insert,1|string',
            'staffid_start_from' => 'required_if:staffid_auto_insert,1|integer',
            'staffid_no_digit' => 'required_if:staffid_auto_insert,1|integer|check_staff_id_digit'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $data = $request->only([
                'adm_auto_insert', 'adm_prefix', 'adm_start_from', 'adm_no_digit',
                'staffid_auto_insert', 'staffid_prefix', 'staffid_start_from', 'staffid_no_digit'
            ]);
            $data['adm_update_status'] = 1;
            $data['staffid_update_status'] = 1;

            if ($request->adm_auto_insert && (
                $setting->adm_prefix != $request->adm_prefix ||
                $setting->adm_start_from != $request->adm_start_from ||
                $setting->adm_no_digit != $request->adm_no_digit
            )) {
                $data['adm_update_status'] = 0;
            }

            if ($request->staffid_auto_insert && (
                $setting->staffid_prefix != $request->staffid_prefix ||
                $setting->staffid_start_from != $request->staffid_start_from ||
                $setting->staffid_no_digit != $request->staffid_no_digit
            )) {
                $data['staffid_update_status'] = 0;
            }

            $setting->update($data);
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'ID auto-generation settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateAttendanceType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'attendence_type' => 'required|in:0,1',
            'biometric' => 'nullable|boolean',
            'biometric_device' => 'nullable|string',
            'low_attendance_limit' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'fail', 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $setting->update($request->only([
                'attendence_type', 'biometric', 'biometric_device', 'low_attendance_limit'
            ]));
            DB::commit();

            return response()->json(['status' => 'success', 'message' => 'Attendance settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateMaintenance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'maintenance_mode' => 'required|boolean'
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $setting->update(['maintenance_mode' => $request->maintenance_mode]);
            DB::commit();

            return response()->json(['status' => 1, 'message' => 'Maintenance settings updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    public function updateLoginPageBackground(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required|integer',
            'logo_type' => 'required|in:admin_logo,user_logo',
            'file' => 'required|image|mimes:jpg,jpeg,png|max:1024'
        ]);

        if ($validator->fails()) {
            return response()->json(['success' => false, 'error' => $validator->errors()], 422);
        }

        try {
            DB::beginTransaction();
            $setting = SchSetting::find($request->id);
            if (!$setting) {
                return response()->json(['message' => 'Setting not found'], 404);
            }

            $field = $request->logo_type === 'admin_logo' ? 'admin_login_page_background' : 'user_login_page_background';
            $oldImage = $setting->$field;

            if ($oldImage && Storage::exists('public/uploads/school_content/login_image/' . $oldImage)) {
                Storage::delete('public/uploads/school_content/login_image/' . $oldImage);
            }

            $file = $request->file('file');
            $fileName = $setting->id . '_' . $request->logo_type . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/uploads/school_content/login_image', $fileName);

            $setting->update([$field => $fileName]);
            DB::commit();

            return response()->json(['success' => true, 'message' => 'Login page background updated successfully'], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }
}

// Custom Validation Rules (Add to a Service Provider, e.g., AppServiceProvider)

Validator::extend('check_admission_digit', function ($attribute, $value, $parameters, $validator) {
    $data = $validator->getData();
    $adm_start_from = $data['adm_start_from'] ?? '';
    $adm_no_digit = $data['adm_no_digit'] ?? '';
    return !$adm_no_digit || strlen((string)$adm_start_from) == $adm_no_digit;
}, 'The admission start number must be :value digits long.');

Validator::extend('check_staff_id_digit', function ($attribute, $value, $parameters, $validator) {
    $data = $validator->getData();
    $staffid_start_from = $data['staffid_start_from'] ?? '';
    $staffid_no_digit = $data['staffid_no_digit'] ?? '';
    return !$staffid_no_digit || strlen((string)$staffid_start_from) == $staffid_no_digit;
}, 'The staff ID start number must be :value digits long.');