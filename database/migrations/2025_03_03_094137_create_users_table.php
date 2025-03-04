<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->string('role')->nullable();
            $table->boolean('status')->default(false);
            $table->unsignedBigInteger('lang_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('verification_code')->nullable();
            $table->unsignedBigInteger('currency_id')->nullable();
            $table->timestamps();

            $table->foreign('lang_id')->references('id')->on('languages')->onDelete('set null');
            $table->foreign('currency_id')->references('id')->on('currencies')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
}