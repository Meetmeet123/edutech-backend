<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailConfigTable extends Migration
{
    public function up()
    {
        Schema::create('email_config', function (Blueprint $table) {
            $table->id();
            $table->string('email_type')->nullable(); // Inferred from get_emailbytype method
            $table->string('smtp_username')->nullable();
            $table->string('smtp_password')->nullable();
            $table->boolean('status')->default(false); // Replaced is_active with status (false for no)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('email_config');
    }
}