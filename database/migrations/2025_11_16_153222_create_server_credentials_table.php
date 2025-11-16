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
        Schema::create('server_credentials', function (Blueprint $table) {
            $table->id();
            $table->foreignId('server_id')->constrained()->cascadeOnDelete();
            $table->string('credential_type', 50);
            $table->string('username')->nullable();
            $table->text('password_encrypted')->nullable();
            $table->text('ssh_key_encrypted')->nullable();
            $table->integer('port')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();

            $table->index('server_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('server_credentials');
    }
};
