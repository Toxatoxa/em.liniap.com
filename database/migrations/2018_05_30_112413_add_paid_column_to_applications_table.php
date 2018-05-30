<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPaidColumnToApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('as_applications', function (Blueprint $table) {
            $table->decimal('price', 7, 2)->nullable()->default(NULL)->after('country_code');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('as_applications', function (Blueprint $table) {
            $table->dropColumn('price');
        });
    }
}
