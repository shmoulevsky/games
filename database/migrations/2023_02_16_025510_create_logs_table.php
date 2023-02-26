<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logs', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('url')->nullable();
            $table->json('headers')->nullable();
            $table->json('params')->nullable();
            $table->text('exception')->nullable();
            $table->string('file')->nullable();
            $table->string('line')->nullable();
            $table->integer('user_id')->nullable();
            $table->text('trace')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logs');
    }
}
