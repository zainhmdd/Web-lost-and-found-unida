<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->foreignId('location_id')->constrained()->onDelete('cascade');
            $table->enum('type', ['lost', 'found'])->default('found');
            $table->string('name');
            $table->text('description');
            $table->date('date');
            $table->json('images');
            $table->boolean('has_reward')->default(false);
            $table->string('reward_description')->nullable();
            $table->enum('status', ['waiting', 'verified', 'claimed', 'returned'])->default('waiting');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('items');
    }
};