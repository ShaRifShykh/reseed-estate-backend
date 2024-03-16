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
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->string("asset");
            $table->longText("description");
            $table->string("price");
            $table->string("location");
            $table->string("latitude");
            $table->string("longitude");
            $table->unsignedBigInteger("created_by");
            $table->timestamps();
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('created_by')->references('id')->on('users')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
