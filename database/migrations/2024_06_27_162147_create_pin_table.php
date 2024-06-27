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
        Schema::create('pin', function (Blueprint $table) {
            $table->id();
            $table->integer('pin_code');
            $table->tinyInteger('is_used')->default(0);
            $table->foreignId('receiver_id')->nullable()->constrained('delivery_users')->onDelete('cascade');
            $table->foreignId('storage_id')->nullable()->constrained('storage_users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pin');
    }
};
