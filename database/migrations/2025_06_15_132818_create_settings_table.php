<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
Schema::create('settings', function (Blueprint $table) {
    $table->id();
    $table->string('mpesa_api_key')->nullable();
    $table->boolean('enable_swahili')->default(false);
    $table->decimal('roi_multiplier', 5, 2)->default(1.00);
    $table->date('next_payout')->nullable();
    $table->string('site_name')->default('AutoVest');
    $table->string('site_email')->nullable();
    $table->string('site_phone')->nullable();
    $table->text('site_description')->nullable();
    $table->decimal('min_investment', 10, 2)->default(100.00);
    $table->decimal('max_investment', 10, 2)->default(100000.00);
    $table->integer('payout_frequency_days')->default(30);
    $table->boolean('maintenance_mode')->default(false);
    $table->text('maintenance_message')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
