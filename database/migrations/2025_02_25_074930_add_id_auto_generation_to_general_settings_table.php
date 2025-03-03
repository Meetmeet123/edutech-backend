<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdAutoGenerationToGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->boolean('adm_auto_insert')->default(false);
            $table->string('adm_prefix')->nullable();
            $table->integer('adm_no_digit')->nullable();
            $table->integer('adm_start_from')->nullable();
            $table->boolean('staffid_auto_insert')->default(false);
            $table->string('staffid_prefix')->nullable();
            $table->integer('staffid_no_digit')->nullable();
            $table->integer('staffid_start_from')->nullable();
        });
    }

    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'adm_auto_insert', 'adm_prefix', 'adm_no_digit', 'adm_start_from',
                'staffid_auto_insert', 'staffid_prefix', 'staffid_no_digit', 'staffid_start_from'
            ]);
        });
    }
}