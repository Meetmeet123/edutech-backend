<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateComplaintsTable extends Migration
{
    public function up()
    {
        Schema::create('complaints', function (Blueprint $table) {
            $table->id();
            $table->string('complaint_type');
            $table->string('source');
            $table->string('name');
            $table->string('contact')->nullable();
            $table->date('date');
            $table->text('description')->nullable();
            $table->text('action_taken')->nullable();
            $table->string('assigned')->nullable();
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('complaints');
    }
}