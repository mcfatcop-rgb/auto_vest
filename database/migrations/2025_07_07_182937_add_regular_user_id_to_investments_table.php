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
    Schema::table('investments', function (Blueprint $table) {
        $table->unsignedBigInteger('regular_user_id')->after('id');

        $table->foreign('regular_user_id')
              ->references('id')
              ->on('regular_users')
              ->onDelete('cascade');
    });
}

public function down()
{
    Schema::table('investments', function (Blueprint $table) {
        $table->dropForeign(['regular_user_id']);
        $table->dropColumn('regular_user_id');
    });
}
};
