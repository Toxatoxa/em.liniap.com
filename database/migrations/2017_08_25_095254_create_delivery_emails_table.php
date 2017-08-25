<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDeliveryEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('delivery_emails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('delivery_id')->unsigned()->index();
            $table->string('recipient_email');
            $table->timestamp('sent_at')->nullable()->default(null);
            $table->timestamp('received_at')->nullable()->default(null);
            $table->timestamp('opened_at')->nullable()->default(null);
            $table->timestamp('error_at')->nullable()->default(null);
            $table->timestamps();
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
        Schema::dropIfExists('delivery_emails');
    }
}
