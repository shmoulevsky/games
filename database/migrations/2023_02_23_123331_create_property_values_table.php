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
        Schema::create('property_values', function (Blueprint $table) {

            $table->bigInteger('property_id')->unsigned();
            $table->foreign('property_id')
                ->references('id')->on('properties')
                ->onDelete('cascade');
            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->foreign('language_id')
                ->references('id')->on('languages')
                ->onDelete('set null');
            $table->json('json');
            $table->text('value');
            $table->unique(['property_id', 'language_id']);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('property_values');
    }
};
