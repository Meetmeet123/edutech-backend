<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMiscellaneousToGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->boolean('my_question')->default(false); // 0: Disabled, 1: Enabled
            $table->string('scan_code_type')->default('barcode'); // 'barcode' or 'qrcode'
            $table->boolean('exam_result')->default(false); // 0: Disabled, 1: Enabled
            $table->string('class_teacher')->default('no'); // 'no' or 'yes'
            $table->string('superadmin_restriction')->default('disabled'); // 'disabled' or 'enabled'
            $table->string('event_reminder')->default('disabled'); // 'disabled' or 'enabled'
            $table->integer('calendar_event_reminder')->nullable(); // Days before reminder
            $table->string('staff_notification_email')->nullable(); // Email for staff leave notifications
        });
    }

    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'my_question', 'scan_code_type', 'exam_result', 'class_teacher',
                'superadmin_restriction', 'event_reminder', 'calendar_event_reminder',
                'staff_notification_email'
            ]);
        });
    }
}