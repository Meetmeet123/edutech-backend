<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBackupTable extends Migration
{
    public function up()
    {
        Schema::create('backup', function (Blueprint $table) {
            $table->id();
            $table->string('app_version')->nullable();
            $table->string('cron_secret_key')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('backup');
    }
}