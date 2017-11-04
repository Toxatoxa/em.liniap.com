<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsDevelopersTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_developers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('as_id', 50)->index();
            $table->string('name');
            $table->string('url');
            $table->string('site')->nullable()->default(null);
            $table->string('email')->nullable()->default(null);
            $table->timestamp('emailed_at')->nullable()->default(null);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('as_developers');
    }
}
