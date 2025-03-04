<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarSubMenusTable extends Migration
{
    public function up()
    {
        Schema::create('sidebar_sub_menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('sidebar_menu_id');
            $table->boolean('status')->default(true);
            $table->integer('level')->default(0);
            $table->string('key')->nullable();
            $table->unsignedBigInteger('permission_group_id')->nullable();
            $table->timestamps();

            $table->foreign('sidebar_menu_id')->references('id')->on('sidebar_menus')->onDelete('cascade');
            $table->foreign('permission_group_id')->references('id')->on('permission_group')->onDelete('set null');
        });
    }

    public function down()
    {
        Schema::dropIfExists('sidebar_sub_menus');
    }
}