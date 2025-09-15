<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCompanyIdToInvestmentsTable extends Migration
{
    public function up()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->after('user_id')->nullable();

            // Add foreign key constraint if needed
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('investments', function (Blueprint $table) {
            $table->dropForeign(['company_id']);
            $table->dropColumn('company_id');
        });
    }
}
