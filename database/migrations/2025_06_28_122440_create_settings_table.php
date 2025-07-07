<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('mpesa_api_key')->nullable();
            $table->boolean('enable_swahili')->default(false);
            // Add any other global settings columns here
        });
    }

    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
