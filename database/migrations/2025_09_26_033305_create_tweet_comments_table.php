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
        Schema::create('tweet_comments', function (Blueprint $table) {
            $table->id();

            $table->string("comment_content", 180)->nullable();
            $table->integer("likes_count")->default(0);

            $table->foreignId('user_id')->constrained()->onDelete("cascade");
            $table->foreignId('tweet_id')->constrained()->onDelete("cascade");

            $table->foreignId('parent_id') // Comentario padre (si es respuesta)
                    ->nullable()
                    ->constrained('tweet_comments')
                    ->onDelete('cascade');




            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tweet_comments');
    }
};
