<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiletypesTable extends Migration
{
    public function up()
    {
        Schema::create('filetypes', function (Blueprint $table) {
            $table->id();
            $table->string('type')->nullable(); // Inferred field for file type
            $table->boolean('status')->default(true); // Inferred status field
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('filetypes');
    }
}