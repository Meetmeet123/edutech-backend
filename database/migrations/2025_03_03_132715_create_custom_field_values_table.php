<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomFieldValuesTable extends Migration
{
    public function up()
    {
        Schema::create('custom_field_values', function (Blueprint $table) {
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
        Schema::dropIfExists('custom_field_values');
    }
}