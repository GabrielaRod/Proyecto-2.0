<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reports', function (Blueprint $table) {
            $table->id()->unique();
            $table->char('VIN'); 
            $table->string('Make');
            $table->string('Model');
            $table->string('Color');
            $table->string('FirstName');
            $table->string('LastName');
            $table->char('PhoneNumber');
            $table->enum('Status', ['ACTIVE','INACTIVE'])->default('ACTIVE');            
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
        Schema::dropIfExists('reports');
    }
}
