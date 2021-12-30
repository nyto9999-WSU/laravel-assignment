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
            $table->id();

            $table->date('start_date')->nullable();
            $table->date('start_time')->nullable();
            $table->date('end')->nullable();
            $table->foreignId('order_id')
                    ->constrained()
                    ->onDelete('cascade');

            /* techician id */
            $table->foreignId('user_id')
                    ->constrained()
                    ->onDelete('cascade');
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
        Schema::dropIfExists('jobs');
    }
}
