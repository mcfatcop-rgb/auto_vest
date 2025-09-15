<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUserIdFromInvestmentsTable extends Migration
{
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            // Drop the foreign key constraint first
            $table->dropForeign(['user_id']);

            // Then drop the column
            $table->dropColumn('user_id');
        });
    }

    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            // Optional: restore the column and foreign key in rollback
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
        });
    }
}
