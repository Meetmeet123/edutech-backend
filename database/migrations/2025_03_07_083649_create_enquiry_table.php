<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryTable extends Migration
{
    public function up()
    {
        Schema::create('enquiry', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->string('address')->nullable();
            $table->string('reference')->nullable();
            $table->date('date');
            $table->text('description')->nullable();
            $table->date('follow_up_date')->nullable();
            $table->text('note')->nullable();
            $table->string('source');
            $table->string('email')->nullable();
            $table->string('assigned')->nullable();
            $table->unsignedBigInteger('class')->nullable();
            $table->integer('no_of_child')->nullable();
            $table->string('status')->default('active');
            $table->timestamps();

            $table->foreign('class')->references('id')->on('classes')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('enquiry');
    }
}
