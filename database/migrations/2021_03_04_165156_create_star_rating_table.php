<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStarRatingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('star_rating', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guest_id')->unsigned();
            $table->integer('booking_id')->unsigned();
            $table->integer('level');
            $table->text('description')->nullable();
            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('booking_id')->references('id')->on('booking');
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
        Schema::dropIfExists('star_rating');
    }
}
