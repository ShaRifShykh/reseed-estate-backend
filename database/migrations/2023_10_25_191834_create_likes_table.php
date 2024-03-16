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
        Schema::create('likes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("liked_by");

            $table->unsignedBigInteger("post_id")->nullable();
            $table->unsignedBigInteger("reel_id")->nullable();
            $table->timestamps();
        });

        Schema::table('likes', function (Blueprint $table) {
            $table->foreign('liked_by')->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->foreign('post_id')->references('id')
                ->on('posts')
                ->onDelete('cascade');
            $table->foreign('reel_id')->references('id')
                ->on('reels')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('likes');
    }
};
