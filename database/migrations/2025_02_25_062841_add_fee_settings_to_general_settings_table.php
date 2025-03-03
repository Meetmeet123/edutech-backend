<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeSettingsToGeneralSettingsTable extends Migration
{
    public function up()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->boolean('is_offline_fee_payment')->default(false);
            $table->text('offline_bank_payment_instruction')->nullable();
            $table->boolean('is_student_feature_lock')->default(false);
            $table->integer('lock_grace_period')->nullable();
            $table->json('duplicate_fees_invoice')->nullable();
            $table->integer('fee_due_days')->default(0);
            $table->boolean('single_page_print')->default(false);
            $table->boolean('collect_back_date_fees')->default(false);
        });
    }

    public function down()
    {
        Schema::table('general_settings', function (Blueprint $table) {
            $table->dropColumn([
                'is_offline_fee_payment', 'offline_bank_payment_instruction',
                'is_student_feature_lock', 'lock_grace_period',
                'duplicate_fees_invoice', 'fee_due_days',
                'single_page_print', 'collect_back_date_fees'
            ]);
        });
    }
}