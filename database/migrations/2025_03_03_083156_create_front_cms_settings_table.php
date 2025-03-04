<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFrontCmsSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('front_cms_settings', function (Blueprint $table) {
            $table->id();
            $table->string('url')->unique()->nullable(); // Inferred from valid_check_exists
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('front_cms_settings');
    }
}