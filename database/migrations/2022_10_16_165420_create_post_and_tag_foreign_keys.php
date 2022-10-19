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
    public function up(): void
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('tag_id')->references('id')->on('tags');
        });

        Schema::table('post_translations', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts');
            $table->foreign('language_id')->references('id')->on('languages');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::table('post_tags', function (Blueprint $table) {
            $table->dropForeign('post_id');
            $table->dropForeign('tag_id');
        });

        Schema::table('post_translations', function (Blueprint $table) {
            $table->dropForeign('post_id');
            $table->dropForeign('language_id');
        });
    }
};
