<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('guest_id')->nullable()->unsigned();
            $table->integer('room_id')->unsigned();
            $table->string('name');
            $table->string('email');
            $table->dateTime('booking_date');
            $table->dateTime('check_in_date');
            $table->dateTime('check_out_date');
            $table->integer('number_room');
            $table->string('booking_note')->nullable();
            $table->integer('is_payment');
            $table->foreign('guest_id')->references('id')->on('guests');
            $table->foreign('room_id')->references('id')->on('room');
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
        Schema::dropIfExists('booking');
    }
}
