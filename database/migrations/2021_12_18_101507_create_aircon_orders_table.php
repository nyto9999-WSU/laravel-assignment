<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirconOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircon_order', function (Blueprint $table) {
            $table->id();

            $table->foreignId('aircon_id')->nullable()
                    ->constrained()
                    ->onDelete('cascade');
            $table->foreignId('order_id')->nullable()
                    ->constrained()
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
        Schema::dropIfExists('aircon_order');
    }
}
