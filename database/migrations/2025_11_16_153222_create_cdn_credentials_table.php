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
        Schema::create('cdn_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cdn_id')->constrained()->cascadeOnDelete();
            $table->text('api_key_encrypted')->nullable();
            $table->text('api_secret_encrypted')->nullable();
            $table->string('email')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('cdn_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cdn_credentials');
    }
};
