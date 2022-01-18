<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAirconsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aircons', function (Blueprint $table) {
            $table->id();
            $table->string('model_number')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('equipment_type')->nullable();
            $table->string('other_type')->nullable();
            $table->string('domestic_commercial')->nullable();
            $table->string('install_address')->nullable();
            $table->string('issue')->nullable();
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
        Schema::dropIfExists('aircons');
    }
}
