<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsPurposeTable extends Migration
{
    public function up()
    {
        Schema::create('visitors_purpose', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Assuming purpose has a name field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors_purpose');
    }
}