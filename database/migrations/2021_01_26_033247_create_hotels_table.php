<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('province_id')->unsigned();
            $table->integer('category_id')->unsigned();
            $table->string('hotel_name');
            $table->string('hotel_phone');
            $table->string('hotel_email');
            $table->string('hotel_website')->nullable();
            $table->string('hotel_image');
            $table->text('description')->nullable();
            $table->integer('is_active')->default(1);
            $table->foreign('province_id')->references('id')->on('provinces');
            $table->foreign('category_id')->references('id')->on('categories');
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
        Schema::dropIfExists('hotels');
    }
}
