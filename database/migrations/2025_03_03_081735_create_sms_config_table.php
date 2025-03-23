<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSmsConfigTable extends Migration
{
    public function up()
    {
        Schema::create('sms_config', function (Blueprint $table) {
            $table->id();
            $table->string('type')->unique(); // Inferred from the add method
            $table->boolean('status')->default(false); // Replaced is_active with status (false for disabled)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('sms_config');
    }
}