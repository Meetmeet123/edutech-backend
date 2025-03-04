<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionStudentTable extends Migration
{
    public function up()
    {
        Schema::create('permission_student', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('group_id');
            $table->boolean('student')->default(false);
            $table->boolean('parent')->default(false);
            $table->boolean('status')->default(false);
            $table->timestamps();

            $table->foreign('group_id')->references('id')->on('permission_group')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_student');
    }
}