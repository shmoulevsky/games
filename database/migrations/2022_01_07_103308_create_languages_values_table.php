<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLanguagesValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages_values', function (Blueprint $table) {
            $table->id();
            $table->integer('language_id')->default(0);
            $table->string('code');
            $table->string('translation');
            $table->integer('group_id')->index()->default(0);
            $table->string('group',255)->default(null);
           // $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages_values');
    }
}
