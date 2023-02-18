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
        Schema::table('users', function (Blueprint $table) {

            $table->string('photo')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('sex')->nullable();
            $table->string('city', 25)->nullable();
            $table->string('country', 25)->nullable();
            $table->string('oauth_type', 8)->nullable();
            $table->string('oauth_id')->index()->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropColumn('city');
                $table->dropColumn('birthday');
                $table->dropColumn('sex');
                $table->dropColumn('country');
                $table->dropColumn('oauth_type');
                $table->dropColumn('oauth_id');
                $table->dropColumn('photo');
            });
        });
    }
};
