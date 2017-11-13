<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTemplateIdToDeliveryEmailsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_emails', function (Blueprint $table) {
            $table->integer('template_id')->unsigned()->nullable()->default(null)->after('delivery_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('delivery_emails', function (Blueprint $table) {
            $table->dropColumn('template_id');
        });
    }
}
