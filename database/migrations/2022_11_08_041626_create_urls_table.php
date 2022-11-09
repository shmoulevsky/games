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
        Schema::create('urls', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('entity')->index();
            $table->bigInteger('entity_id')->unsigned()->index();
            $table->bigInteger('language_id')->unsigned();
            $table->boolean('is_list')->default(0);
            $table->json('list')->nullable();

            $table->foreign('language_id')
                ->references('id')->on('languages')
                ->onDelete('cascade');
            $table->string('url')->unique()->index();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('urls');
    }
};
