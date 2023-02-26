<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('user_groups', function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(null);
            $table->json('page_access')->nullable();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastname',255)->nullable();
            $table->string('email')->unique()->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone',30)->unique()->nullable();
            $table->timestamp('phone_verified_at')->nullable();

            $table->string('password');
            $table->rememberToken();
            $table->integer('group_id')->index()->default(0);
            $table->integer('access_panel')->default(0);
            $table->integer('language_id')->default(1)->index();
            $table->bigInteger('ref_id')->index()->nullable();
            $table->bigInteger('country_id')->unsigned()->nullable();
            $table->foreign('country_id')
                ->references('id')->on('countries')
                ->onDelete('cascade');
            $table->dateTime('last_activity')->nullable();
            $table->integer('status')->default(1);
            $table->string('hash',255)->nullable();
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
        Schema::dropIfExists('users');
    }
}
