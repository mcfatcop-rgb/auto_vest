<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Migrations\Migration;   // ←  add/import this


return new class extends Migration
{
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->integer('amount');
        });
    }

    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropColumn('amount');
        });
    }
};

