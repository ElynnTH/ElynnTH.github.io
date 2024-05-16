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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->Constraint()->cascadeOnDelete();
            $table->string('status')->default('Active');
            $table->string('urgent')->default('low');
            $table->foreignId('category_id')->constrained()->onDelete('cascade');
            $table->string('content');
            $table->string('title')->nullable();
            $table->unsignedInteger('rate')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
