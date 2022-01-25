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
            $table->string('tech_name')->nullable();

            $table->foreignId('order_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('prefer_date');
            $table->string('prefer_time')->nullable();
            $table->date('start_date')->nullable();
            $table->string('start_time')->nullable();
            $table->dateTime('end_date')->nullable();
            $table->string('status')->default('booked');
            $table->dateTime('assigned_at')->nullable();

            /* aircon attrs */
            $table->string('aircon_id');
            $table->string('model_number');
            $table->string('serial_number');
            $table->string('equipment_type');
            $table->string('other_type')->nullable();
            $table->string('domestic_commercial');
            $table->string('install_address');
            $table->text('issue')->nullable();

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
