<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUserVehicleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_user_vehicle', function (Blueprint $table) {
            $table->foreignId('app_user_id')->references('id')->on('app_users')->cascadeOnDelete();
            $table->foreignId('vehicle_id')->references('id')->on('vehicles')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('app_user_vehicle');
    }
}
