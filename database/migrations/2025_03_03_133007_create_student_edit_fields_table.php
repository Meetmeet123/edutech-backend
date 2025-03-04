<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentEditFieldsTable extends Migration
{
    public function up()
    {
        Schema::create('student_edit_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('status')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('student_edit_fields');
    }
}
