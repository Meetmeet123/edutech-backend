<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GeneralSetting extends Model
{
    protected $fillable = [
        'school_name', 'school_code', 'address', 'phone', 'email',
        'session_id', 'start_month', 'date_format', 'timezone',
        'start_week', 'currency_format', 'base_url', 'folder_path',
        'print_logo', 'admin_logo', 'admin_small_logo', 'app_logo',
        'admin_login_page_background', 'user_login_page_background',
        'theme',
        'mobile_api_url', 'app_primary_color_code', 'app_secondary_color_code',
        'admin_mobile_api_url', 'admin_app_primary_color_code', 'admin_app_secondary_color_code',
        'envato_purchase_code', 'envato_email',
        'student_panel_login', 'parent_panel_login',
        'student_login_options', 'parent_login_options',
        'student_timeline',
        'is_offline_fee_payment', 'offline_bank_payment_instruction',
        'is_student_feature_lock', 'lock_grace_period',
        'duplicate_fees_invoice', 'fee_due_days',
        'single_page_print', 'collect_back_date_fees',
        'adm_auto_insert', 'adm_prefix', 'adm_no_digit', 'adm_start_from',
        'staffid_auto_insert', 'staffid_prefix', 'staffid_no_digit', 'staffid_start_from',
        'attendence_type', 'biometric', 'biometric_device', 'low_attendance_limit',
        'maintenance_mode',
        'my_question', 'scan_code_type', 'exam_result', 'class_teacher', // Added
        'superadmin_restriction', 'event_reminder', 'calendar_event_reminder', // Added
        'staff_notification_email', // Added
    ];

    protected $casts = [
        'student_login_options' => 'array',
        'parent_login_options' => 'array',
        'duplicate_fees_invoice' => 'array',
    ];
}