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
    Schema::table('referrals', function (Blueprint $table) {
        $table->unsignedBigInteger('referrer_id')->nullable()->after('id');
        $table->foreign('referrer_id')->references('id')->on('regular_users')->onDelete('set null');
    });
}

public function down()
{
    Schema::table('referrals', function (Blueprint $table) {
        $table->dropForeign(['referrer_id']);
        $table->dropColumn('referrer_id');
    });
}
};
