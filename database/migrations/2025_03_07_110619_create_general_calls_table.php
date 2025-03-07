<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeneralCallsTable extends Migration
{
    public function up()
    {
        Schema::create('general_calls', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('contact');
            $table->date('date');
            $table->text('description')->nullable();
            $table->string('call_dureation')->nullable(); // Assuming typo in original 'call_dureation'
            $table->text('note')->nullable();
            $table->string('call_type');
            $table->date('follow_up_date')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('general_calls');
    }
}