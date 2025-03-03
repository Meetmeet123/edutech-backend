<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('general_settings', function (Blueprint $table) {
            $table->id();
            $table->string('school_name');
            $table->string('school_code')->nullable();
            $table->text('address');
            $table->string('phone');
            $table->string('email');
            $table->string('session_id', 50)->nullable();
            $table->string('start_month'); // e.g., January, February
            $table->string('date_format'); // e.g., d/m/Y
            $table->string('timezone'); // e.g., UTC
            $table->string('start_week'); // e.g., Monday
            $table->string('currency_format'); // e.g., $0.00
            $table->string('base_url'); // File upload base URL
            $table->string('folder_path'); // File upload folder path
            $table->boolean('attendence_type')->default(false); // 0: Day-wise, 1: Period-wise
            $table->boolean('biometric')->default(false); // 0: Disabled, 1: Enabled
            $table->string('biometric_device')->nullable(); // Comma-separated list
            $table->integer('low_attendance_limit')->nullable(); // Percentage
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_settings');
    }
}