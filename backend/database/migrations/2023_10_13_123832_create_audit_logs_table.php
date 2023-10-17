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
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->id();
            $table->uuid('log_uuid');
            $table->string("model_name", 255)->nullable();
            $table->string("model_path", 255)->nullable();
            $table->enum('event', ["CREATE", "UPDATE", "DELETE", "LOGIN"]);
            $table->enum('status', ["SUCCESS", "FAILED"]);
            $table->text("log_description")->nullable();
            $table->foreignIdFor(\App\Models\User::class, 'log_creator')->nullable();
            $table->json('properties')->nullable();
            $table->timestamps();
            $table->index('log_uuid');
            $table->index('model_name');
            $table->index(['model_name', 'event']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
    }
};
