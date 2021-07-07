<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAntennasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('antennas', function (Blueprint $table) {
            $table->id();
            $table->char('MacAddress')->unique(); 
            $table->string('Location');
            $table->unsignedBigInteger('coordinate_id');
            $table->enum('Status', ['ACTIVE','INACTIVE'])->default('ACTIVE');         
            $table->timestamps();

            $table->foreign('coordinate_id')->references('id')->on('coordinates')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('antennas');
    }
}
