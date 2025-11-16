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
        Schema::create('wp_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->string('admin_url', 500);
            $table->string('username');
            $table->text('password_encrypted');
            $table->string('role', 50)->default('administrator');
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('site_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('wp_credentials');
    }
};
