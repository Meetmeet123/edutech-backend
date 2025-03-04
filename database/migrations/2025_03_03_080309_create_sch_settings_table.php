<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('sch_settings', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('lastname')->default(0);
            $table->tinyInteger('middlename')->default(0);
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->json('languages')->nullable();
            $table->string('class_teacher', 100)->nullable();
            $table->string('cron_secret_key', 100)->nullable();
            $table->string('timezone', 50)->nullable();
            $table->tinyInteger('superadmin_restriction')->default(0);
            $table->tinyInteger('student_timeline')->default(0);
            $table->string('name', 100)->nullable();
            $table->string('email', 100)->nullable();
            $table->tinyInteger('biometric')->default(0);
            $table->string('biometric_device', 100)->nullable();
            $table->string('time_format', 50)->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('attendence_type', 50)->nullable();
            $table->text('address')->nullable();
            $table->string('dise_code', 50)->nullable();
            $table->string('date_format', 50)->nullable();
            $table->unsignedBigInteger('currency')->nullable();
            $table->string('currency_place', 10)->nullable();
            $table->string('start_month', 10)->nullable();
            $table->string('start_week', 10)->nullable();
            $table->unsignedBigInteger('session_id')->nullable();
            $table->string('fee_due_days', 10)->nullable();
            $table->string('image', 100)->nullable();
            $table->string('theme', 50)->nullable();
            $table->tinyInteger('online_admission')->default(0);
            $table->tinyInteger('is_duplicate_fees_invoice')->default(0);
            $table->tinyInteger('is_student_house')->default(0);
            $table->tinyInteger('is_blood_group')->default(0);
            $table->string('admin_logo', 100)->nullable();
            $table->string('admin_small_logo', 100)->nullable();
            $table->string('mobile_api_url', 100)->nullable();
            $table->string('app_primary_color_code', 20)->nullable();
            $table->string('app_secondary_color_code', 20)->nullable();
            $table->string('app_logo', 100)->nullable();
            $table->tinyInteger('student_profile_edit')->default(0);
            $table->tinyInteger('staff_barcode')->default(0);
            $table->tinyInteger('student_barcode')->default(0);
            $table->tinyInteger('student_panel_login')->default(0);
            $table->tinyInteger('parent_panel_login')->default(0);
            $table->string('currency_format', 10)->nullable();
            $table->tinyInteger('exam_result')->default(0);
            $table->string('base_url', 100)->nullable();
            $table->string('folder_path', 100)->nullable();
            $table->tinyInteger('status')->default(0);
            $table->string('low_attendance_limit', 10)->nullable();
            $table->tinyInteger('roll_no')->default(0);
            $table->tinyInteger('category')->default(0);
            $table->tinyInteger('religion')->default(0);
            $table->tinyInteger('cast')->default(0);
            $table->tinyInteger('mobile_no')->default(0);
            $table->tinyInteger('student_email')->default(0);
            $table->tinyInteger('admission_date')->default(0);
            $table->tinyInteger('student_photo')->default(0);
            $table->tinyInteger('student_height')->default(0);
            $table->tinyInteger('student_weight')->default(0);
            $table->tinyInteger('measurement_date')->default(0);
            $table->tinyInteger('father_name')->default(0);
            $table->tinyInteger('father_phone')->default(0);
            $table->tinyInteger('father_occupation')->default(0);
            $table->tinyInteger('father_pic')->default(0);
            $table->tinyInteger('mother_name')->default(0);
            $table->tinyInteger('mother_phone')->default(0);
            $table->tinyInteger('mother_occupation')->default(0);
            $table->tinyInteger('mother_pic')->default(0);
            $table->tinyInteger('guardian_name')->default(0);
            $table->tinyInteger('guardian_phone')->default(0);
            $table->tinyInteger('guardian_occupation')->default(0);
            $table->tinyInteger('guardian_relation')->default(0);
            $table->tinyInteger('guardian_email')->default(0);
            $table->tinyInteger('guardian_pic')->default(0);
            $table->tinyInteger('guardian_address')->default(0);
            $table->tinyInteger('current_address')->default(0);
            $table->tinyInteger('permanent_address')->default(0);
            $table->tinyInteger('route_list')->default(0);
            $table->tinyInteger('hostel_id')->default(0);
            $table->tinyInteger('bank_account_no')->default(0);
            $table->tinyInteger('bank_name')->default(0);
            $table->tinyInteger('ifsc_code')->default(0);
            $table->tinyInteger('national_identification_no')->default(0);
            $table->tinyInteger('local_identification_no')->default(0);
            $table->tinyInteger('rte')->default(0);
            $table->tinyInteger('previous_school_details')->default(0);
            $table->tinyInteger('student_note')->default(0);
            $table->tinyInteger('upload_documents')->default(0);
            $table->tinyInteger('staff_designation')->default(0);
            $table->tinyInteger('staff_department')->default(0);
            $table->tinyInteger('staff_last_name')->default(0);
            $table->tinyInteger('staff_father_name')->default(0);
            $table->tinyInteger('staff_mother_name')->default(0);
            $table->tinyInteger('staff_date_of_joining')->default(0);
            $table->tinyInteger('staff_phone')->default(0);
            $table->tinyInteger('staff_emergency_contact')->default(0);
            $table->tinyInteger('staff_marital_status')->default(0);
            $table->tinyInteger('staff_photo')->default(0);
            $table->tinyInteger('staff_current_address')->default(0);
            $table->tinyInteger('staff_permanent_address')->default(0);
            $table->tinyInteger('staff_qualification')->default(0);
            $table->tinyInteger('staff_work_experience')->default(0);
            $table->tinyInteger('staff_note')->default(0);
            $table->tinyInteger('staff_epf_no')->default(0);
            $table->tinyInteger('staff_basic_salary')->default(0);
            $table->tinyInteger('staff_contract_type')->default(0);
            $table->tinyInteger('staff_work_shift')->default(0);
            $table->tinyInteger('staff_work_location')->default(0);
            $table->tinyInteger('staff_leaves')->default(0);
            $table->tinyInteger('staff_account_details')->default(0);
            $table->tinyInteger('staff_social_media')->default(0);
            $table->tinyInteger('staff_upload_documents')->default(0);
            $table->timestamps();
            
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('set null');
            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('set null');
            $table->foreign('currency')->references('id')->on('currencies')->onDelete('set null');
            
        });
    }

    public function down()
    {
        Schema::dropIfExists('sch_settings');
    }
}