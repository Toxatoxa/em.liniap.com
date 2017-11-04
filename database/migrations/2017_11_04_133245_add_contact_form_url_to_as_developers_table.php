<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContactFormUrlToAsDevelopersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('as_developers', function (Blueprint $table) {
            $table->string('contact_url')->after('email')->nullable()->default(null);
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
            $table->dropColumn('contact_url');
        });
    }
}
