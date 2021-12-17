<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('tech_id')->unsigned();
            $table->integer('aircon_id')->unsigned();
            $table->foreign('tech_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

            $table->foreign('aircon_id')
                ->references('id')
                ->on('aircons')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jobs');
    }
}
