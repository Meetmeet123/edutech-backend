<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->string('certificate_name');
            $table->text('certificate_text');
            $table->string('left_header')->nullable();
            $table->string('center_header')->nullable();
            $table->string('right_header')->nullable();
            $table->string('left_footer')->nullable();
            $table->string('center_footer')->nullable();
            $table->string('right_footer')->nullable();
            $table->integer('created_for')->default(2); // 2 for students
            $table->integer('status')->default(1); // 1 for active, 0 for inactive
            $table->string('background_image')->nullable();
            $table->integer('header_height')->default(0);
            $table->integer('content_height')->default(0);
            $table->integer('footer_height')->default(0);
            $table->integer('content_width')->default(0);
            $table->boolean('enable_student_image')->default(0);
            $table->integer('enable_image_height')->default(0);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}