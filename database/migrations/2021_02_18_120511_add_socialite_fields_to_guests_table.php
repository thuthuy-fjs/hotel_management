<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSocialiteFieldsToGuestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('guests', function (Blueprint $table) {
            $table->string('provider')->nullable()->after('image');
            $table->string('provider_id')->nullable()->after('provider');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('guests', function (Blueprint $table) {
            //
        });
    }
}
