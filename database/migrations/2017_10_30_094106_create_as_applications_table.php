<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAsApplicationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('as_applications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('as_id')->unsigned()->index();
            $table->string('name');
            $table->string('url');
            $table->string('developer_id');
            $table->char('country_code');
            $table->timestamp('release_date');
            $table->timestamps();
        });

        Schema::create('as_application_genre', function (Blueprint $table) {
            $table->integer('as_application_id')->unsigned()->index();
            $table->integer('as_genre_id')->unsigned()->index();
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
        Schema::dropIfExists('as_applications');
        Schema::dropIfExists('as_application_genre');
    }
}
