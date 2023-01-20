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
        Schema::table('game_categories', function (Blueprint $table) {
            $table->integer("depth")->default(0);
        });

        Schema::table('page_categories', function (Blueprint $table) {
            $table->integer("depth")->default(0);
        });

        Schema::table('article_categories', function (Blueprint $table) {
            $table->integer("depth")->default(0);
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('game_categories', function (Blueprint $table) {
            $table->dropColumn("depth");
        });

        Schema::table('page_categories', function (Blueprint $table) {
            $table->dropColumn("depth");
        });

        Schema::table('article_categories', function (Blueprint $table) {
            $table->dropColumn("depth");
        });


    }
};
