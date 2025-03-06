<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWhatsappConfigsTable extends Migration
{
    public function up()
    {
        Schema::create('whatsapp_configs', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key
            $table->string('account_sid'); // WhatsApp account SID
            $table->string('account_token'); // WhatsApp account token
            $table->string('is_active')->default('disabled'); // Status: enabled/disabled
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('whatsapp_configs');
    }
}