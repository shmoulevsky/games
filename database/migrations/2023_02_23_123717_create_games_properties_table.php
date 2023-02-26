<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games_properties', function (Blueprint $table) {

            $table->bigInteger('game_id')->unsigned();
            $table->foreign('game_id')
                ->references('id')->on('games')
                ->onDelete('cascade');
            $table->bigInteger('property_id')->unsigned();
            $table->foreign('property_id')
                ->references('id')->on('properties')
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
        Schema::dropIfExists('games_properties');
    }
};
