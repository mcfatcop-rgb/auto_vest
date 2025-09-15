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
        Schema::table('fraud_logs', function (Blueprint $table) {
            $table->string('status')->default('pending')->after('reason');
            $table->text('admin_notes')->nullable()->after('status');
            $table->renameColumn('user_id', 'regular_user_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('fraud_logs', function (Blueprint $table) {
            $table->dropColumn(['status', 'admin_notes']);
            $table->renameColumn('regular_user_id', 'user_id');
        });
    }
};
