<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVisitorsBookTable extends Migration
{
    public function up()
    {
        Schema::create('visitors_book', function (Blueprint $table) {
            $table->id();
            $table->string('purpose');
            $table->string('name');
            $table->string('contact')->nullable();
            $table->string('id_proof')->nullable();
            $table->integer('no_of_pepple')->nullable();
            $table->date('date');
            $table->string('in_time')->nullable();
            $table->string('out_time')->nullable();
            $table->text('note')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('visitors_book');
    }
}