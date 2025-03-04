<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOnlineAdmissionCustomFieldValueTable extends Migration
{
    public function up()
    {
        Schema::create('online_admission_custom_field_value', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('belong_table_id');
            $table->unsignedBigInteger('custom_field_id');
            $table->text('value')->nullable();
            $table->timestamps();

            $table->foreign('custom_field_id')->references('id')->on('custom_fields')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('online_admission_custom_field_value');
    }
}
