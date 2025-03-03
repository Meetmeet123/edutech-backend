<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStudentGuardianSettingsToGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->boolean('student_panel_login')->default(false);
            $table->boolean('parent_panel_login')->default(false);
            $table->json('student_login_options')->nullable();
            $table->json('parent_login_options')->nullable();
            $table->string('student_timeline')->default('disabled');
        });
    }

    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'student_panel_login', 'parent_panel_login',
                'student_login_options', 'parent_login_options',
                'student_timeline'
            ]);
        });
    }
}