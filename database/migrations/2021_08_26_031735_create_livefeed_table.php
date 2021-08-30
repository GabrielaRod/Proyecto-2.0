<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivefeedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livefeed', function (Blueprint $table) {
            $table->id();
            $table->char('Data');
            $table->unsignedBigInteger('location_id');
            $table->timestamps();

            $table->foreign('location_id')->references('id')->on('locations')
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
        Schema::dropIfExists('livefeed');
    }
}
