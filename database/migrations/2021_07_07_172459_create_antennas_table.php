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
            $table->enum('Status', ['ACTIVE','INACTIVE'])->default('ACTIVE');         
            $table->timestamps();
            $table->softDeletes();
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
