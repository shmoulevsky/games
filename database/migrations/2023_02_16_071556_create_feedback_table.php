<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feedback', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('language_id')->index();
            $table->string('name');
            $table->string('email');
            $table->string('url');
            $table->text('message');
            $table->string('ip');

            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onDelete('set null');

            $table->bigInteger('country_id')->unsigned();
            $table->foreign('country_id')
                ->references('id')->on('countries')
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
        Schema::dropIfExists('feedback');
    }
}
