<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFieldsToAsDevelopersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('as_developers', function (Blueprint $table) {
            $table->enum('language_code', ['ru', 'en'])->nullable()->default(null)->after('site');
            $table->string('contact_persona')->nullable()->default(null)->after('name');
            $table->timestamp('checked_at')->nullable()->default(null)->after('created_at');
            $table->timestamp('contacted_at')->nullable()->default(null)->after('checked_at');
            $table->timestamp('received_at')->nullable()->default(null)->after('contacted_at');
            $table->timestamp('signed_at')->nullable()->default(null)->after('received_at');
            $table->softDeletes();
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
            $table->dropColumn('language_code');
            $table->dropColumn('contact_persona');
            $table->dropColumn('checked_at');
            $table->dropColumn('contacted_at');
            $table->dropColumn('received_at');
            $table->dropColumn('signed_at');
            $table->dropColumn('deleted_at');
        });
    }
}
