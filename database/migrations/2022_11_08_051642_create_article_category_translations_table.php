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
        Schema::create('article_category_translations', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
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

            $table->bigInteger('article_category_id')->unsigned()->nullable();
            $table->foreign('article_category_id')
                ->references('id')->on('article_categories')
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
        Schema::dropIfExists('article_category_translations');
    }
};
