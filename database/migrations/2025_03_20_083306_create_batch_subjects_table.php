<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBatchSubjectsTable extends Migration
{
    public function up()
    {
        Schema::create('batch_subjects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('exam_group_id');
            $table->unsignedBigInteger('subject_id');
            $table->string('credit_hours')->nullable();
            $table->date('date_from')->nullable();
            $table->time('time_from')->nullable();
            $table->string('duration')->nullable();
            $table->string('room_no')->nullable();
            $table->integer('max_marks')->nullable();
            $table->integer('min_marks')->nullable();
            $table->timestamps();

            $table->foreign('exam_group_id')->references('id')->on('exam_groups')->onDelete('cascade');
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('batch_subjects');
    }
}