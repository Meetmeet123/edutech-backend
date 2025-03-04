<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarMenusTable extends Migration
{
    public function up()
    {
        Schema::create('sidebar_menus', function (Blueprint $table) {
            $table->id();
            $table->boolean('sidebar_display')->default(false);
            $table->integer('level')->default(0);
            $table->string('menu');
            $table->unsignedBigInteger('permission_group_id')->nullable();
            $table->timestamps();

            $table->foreign('permission_group_id')->references('id')->on('permission_group')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sidebar_menus');
    }
}