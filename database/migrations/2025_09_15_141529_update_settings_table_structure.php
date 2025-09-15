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
        Schema::table('settings', function (Blueprint $table) {
            // Drop existing columns if they exist
            $table->dropColumn(['key', 'value']);
            
            // Add new columns
            $table->string('mpesa_api_key')->nullable()->after('id');
            $table->boolean('enable_swahili')->default(false)->after('mpesa_api_key');
            $table->decimal('roi_multiplier', 5, 2)->default(1.00)->after('enable_swahili');
            $table->date('next_payout')->nullable()->after('roi_multiplier');
            $table->string('site_name')->default('AutoVest')->after('next_payout');
            $table->string('site_email')->nullable()->after('site_name');
            $table->string('site_phone')->nullable()->after('site_email');
            $table->text('site_description')->nullable()->after('site_phone');
            $table->decimal('min_investment', 10, 2)->default(100.00)->after('site_description');
            $table->decimal('max_investment', 10, 2)->default(100000.00)->after('min_investment');
            $table->integer('payout_frequency_days')->default(30)->after('max_investment');
            $table->boolean('maintenance_mode')->default(false)->after('payout_frequency_days');
            $table->text('maintenance_message')->nullable()->after('maintenance_mode');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('settings', function (Blueprint $table) {
            // Drop new columns
            $table->dropColumn([
                'mpesa_api_key',
                'enable_swahili',
                'roi_multiplier',
                'next_payout',
                'site_name',
                'site_email',
                'site_phone',
                'site_description',
                'min_investment',
                'max_investment',
                'payout_frequency_days',
                'maintenance_mode',
                'maintenance_message',
            ]);
            
            // Restore original columns
            $table->string('key')->unique()->after('id');
            $table->string('value')->nullable()->after('key');
        });
    }
};