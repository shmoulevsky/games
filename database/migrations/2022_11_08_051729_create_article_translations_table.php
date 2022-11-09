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
        Schema::create('article_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('content')->nullable();
            $table->json('additional')->nullable();

            $table->string('seo_title')->nullable();
            $table->string('seo_keywords')->nullable();
            $table->string('seo_description')->nullable();
            $table->string('seo_url')->nullable();

            $table->integer('sort');
            $table->boolean('is_active');

            $table->bigInteger('language_id')->unsigned()->nullable();
            $table->foreign('language_id')
                ->references('id')->on('languages')
                ->onDelete('set null');

            $table->bigInteger('article_id')->unsigned()->nullable();
            $table->foreign('article_id')
                ->references('id')->on('articles')
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
        Schema::dropIfExists('article_translations');
    }
};
