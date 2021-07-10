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
            $table->foreignId('antenna_id')->references('id')->on('antennas')->cascadeOnDelete();
            $table->foreignId('coordinate_id')->references('id')->on('coordinates')->cascadeOnDelete();
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
