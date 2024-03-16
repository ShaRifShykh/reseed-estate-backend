<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('post_hashtags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("post_id");
            $table->string("hashtag_id");
            $table->timestamps();
        });

        Schema::table('post_hashtags', function (Blueprint $table) {
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade');
            $table->foreign('hashtag_id')->references('name')->on('hashtags')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_hashtags');
    }
};
