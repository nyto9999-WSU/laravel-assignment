<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();


            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('mobile_number')->nullable();
            $table->string('no_of_unit')->nullable();
            $table->string('install_address')->nullable();
            $table->string('state')->nullable();
            $table->string('suburb')->nullable();
            $table->string('postcode')->nullable();
            $table->date('prefer_date')->nullable();
            $table->string('prefer_time')->nullable();
            $table->string('domestic_commercial')->nullable();
            $table->string('extra_note')->nullable();
            $table->string('status')->default('Booked');
            $table->timestamps();

            $table->foreignId('user_id')
                    ->constrained();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
