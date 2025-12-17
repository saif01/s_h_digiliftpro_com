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
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip_address', 45)->nullable(); // IPv6 can be up to 45 characters
            $table->text('user_agent')->nullable();
            $table->string('url')->nullable(); // The URL/page visited
            $table->string('referer')->nullable(); // HTTP referer
            $table->string('method', 10)->default('GET'); // HTTP method
            $table->string('country')->nullable(); // Country code (can be extracted from IP)
            $table->string('city')->nullable(); // City (can be extracted from IP)
            $table->string('device_type')->nullable(); // mobile, desktop, tablet
            $table->string('browser')->nullable(); // Browser name
            $table->string('os')->nullable(); // Operating system
            $table->integer('session_duration')->nullable(); // Session duration in seconds
            $table->integer('page_views')->default(1); // Number of page views in this session
            $table->boolean('is_bot')->default(false); // Whether the visitor is a bot
            $table->timestamps();
            
            // Indexes for better query performance
            $table->index('ip_address');
            $table->index('url');
            $table->index('created_at');
            $table->index('is_bot');
            $table->index(['ip_address', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
