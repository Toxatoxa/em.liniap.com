<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToDevelopersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('as_developers', function (Blueprint $table) {
            $table->enum('status', ['new', 'emailed', 'hidden', 'en'])->after('as_id')->default('new');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('as_developers', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
