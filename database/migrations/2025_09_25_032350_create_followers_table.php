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
        Schema::create('followers', function (Blueprint $table) {
                      
            $table->foreignId('follower_id')->constrained("users", "id")->index()->onDelete("cascade");
            $table->foreignId('followin_id')->constrained("users", "id")->index()->onDelete("cascade");

            $table->primary(['follower_id', 'followin_id']);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('followers');
    }
};
