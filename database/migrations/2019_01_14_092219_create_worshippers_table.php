<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorshippersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worshippers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('b-date');
            $table->string('email');
            $table->string('phoneNo');
            $table->string('location');
            $table->string('profile_image');
            $table->string('track');
            $table->mediumText('about');
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
        Schema::dropIfExists('worshippers');
    }
}
