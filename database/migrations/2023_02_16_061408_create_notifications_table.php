<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->boolean('is_active');
            $table->string('interval')->nullable();
            $table->string('frequency')->nullable();
            $table->string('delay')->nullable();
            $table->integer('count')->nullable();
            $table->json('channels')->nullable();
            $table->json('groups')->nullable();
            $table->json('users')->nullable();
            $table->bigInteger('notification_type_id')->unsigned();
            $table->foreign('notification_type_id')
                ->references('id')->on('notification_types')
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
        Schema::dropIfExists('notifications');
    }
}
