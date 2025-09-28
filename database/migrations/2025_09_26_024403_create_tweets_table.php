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
        Schema::create('tweets', function (Blueprint $table) {
            $table->id();

            $table->string("tweet_content", 180);
            $table->integer("likes_count")->default(0);
            $table->integer("tweet_retweets_count")->default(0);
            $table->integer("comments_count")->default(0);
            
            $table->foreignId('user_id')->constrained()->onDelete("cascade");


            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweets');
    }
};
