<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsToDeliveryEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('delivery_emails', function (Blueprint $table) {
            $table->timestamp('dropped_at')->nullable()->default(null);
            $table->timestamp('bounced_at')->nullable()->default(null);
            $table->timestamp('complained_at')->nullable()->default(null);
            $table->timestamp('unsubscribed_at')->nullable()->default(null);
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
            $table->dropColumn('dropped_at');
            $table->dropColumn('bounced_at');
            $table->dropColumn('complained_at');
            $table->dropColumn('unsubscribed_at');
        });
    }
}
