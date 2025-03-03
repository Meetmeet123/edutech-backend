<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMobileAppSettingsToGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('mobile_api_url')->nullable();
            $table->string('app_primary_color_code')->nullable();
            $table->string('app_secondary_color_code')->nullable();
            $table->string('admin_mobile_api_url')->nullable();
            $table->string('admin_app_primary_color_code')->nullable();
            $table->string('admin_app_secondary_color_code')->nullable();
            $table->string('envato_purchase_code')->nullable();
            $table->string('envato_email')->nullable();
        });
    }

    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'mobile_api_url', 'app_primary_color_code', 'app_secondary_color_code',
                'admin_mobile_api_url', 'admin_app_primary_color_code', 'admin_app_secondary_color_code',
                'envato_purchase_code', 'envato_email'
            ]);
        });
    }
}