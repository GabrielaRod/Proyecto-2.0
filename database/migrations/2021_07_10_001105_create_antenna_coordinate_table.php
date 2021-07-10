<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntennaCoordinateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antenna_coordinate', function (Blueprint $table) {
            $table->foreignId('mac_address')->references('MacAddress')->on('antennas')->cascadeOnDelete();
            $table->foreignId('location')->references('Location')->on('coordinates')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antenna_coordinate');
    }
}
