<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('app_users', function (Blueprint $table) {
            $table->id();
            $table->char('FirstName', 255); 
            $table->char('LastName', 255);
            $table->char('DomID', 11)->unique();
            $table->string('Address', 500);
            $table->string('City', 250);
            $table->char('PhoneNumber');
            $table->string('Email', 128)->unique();
            $table->char('Password', 255);
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
        Schema::dropIfExists('app_users');
    }
}
