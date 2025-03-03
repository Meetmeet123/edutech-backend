<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->string('print_logo')->nullable();       // For Print Logo
            $table->string('admin_logo')->nullable();       // For Admin Logo
            $table->string('admin_small_logo')->nullable(); // For Admin Small Logo
            $table->string('app_logo')->nullable();         // For App Logo
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn(['print_logo', 'admin_logo', 'admin_small_logo', 'app_logo']);
        });
    }
};
