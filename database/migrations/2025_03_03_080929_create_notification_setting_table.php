<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationSettingTable extends Migration
{
    public function up()
    {
        Schema::create('notification_setting', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // Inferred from the add method
            $table->boolean('status')->default(true); // Replaced is_active with status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('notification_setting');
    }
}