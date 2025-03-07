<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowUpTable extends Migration
{
    public function up()
    {
        Schema::create('follow_up', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enquiry_id');
            $table->date('date');
            $table->date('next_date');
            $table->text('response');
            $table->text('note')->nullable();
            $table->string('followup_by');
            $table->timestamps();

            $table->foreign('enquiry_id')->references('id')->on('enquiry')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('follow_up');
    }
}
