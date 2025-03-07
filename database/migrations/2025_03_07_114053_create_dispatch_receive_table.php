<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDispatchReceiveTable extends Migration
{
    public function up()
    {
        Schema::create('dispatch_receive', function (Blueprint $table) {
            $table->id();
            $table->string('reference_no')->nullable();
            $table->string('to_title');
            $table->text('address')->nullable();
            $table->text('note')->nullable();
            $table->string('from_title');
            $table->date('date');
            $table->string('type'); // 'dispatch' or 'receive'
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dispatch_receive');
    }
}