<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeedTypeToAsApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('as_applications', function (Blueprint $table) {
            $table->tinyInteger('found_feed_id')->unsigned()->default(1)->after('country_code');
        });

        Schema::table('as_developers', function (Blueprint $table) {
            $table->tinyInteger('found_feed_id')->unsigned()->default(1)->after('url');
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
            $table->dropColumn('found_feed_id');
        });

        Schema::table('as_developers', function (Blueprint $table) {
            $table->tinyInteger('found_feed_id')->unsigned()->default(1)->after('country_code');
        });
    }
}
