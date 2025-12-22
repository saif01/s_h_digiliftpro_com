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
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('content')->nullable();
            $table->text('short_description')->nullable();
            
            // Type: company_news, offers_promotions, events, holidays, urgent_alerts
            $table->enum('type', ['company_news', 'offers_promotions', 'events', 'holidays', 'urgent_alerts'])->default('company_news');
            
            // Display type: slider_banner, popup, sidebar_ticker, page_section
            $table->enum('display_type', ['slider_banner', 'popup', 'sidebar_ticker', 'page_section'])->default('slider_banner');
            
            // Media
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            
            // External link
            $table->string('external_link')->nullable();
            $table->boolean('open_in_new_tab')->default(false);
            
            // Date range
            $table->dateTime('start_date')->nullable();
            $table->dateTime('end_date')->nullable();
            
            // Status
            $table->boolean('is_active')->default(true);
            $table->integer('priority')->default(0); // Higher priority shows first
            
            // Multi-language support (optional)
            $table->string('language')->nullable(); // e.g., 'en', 'ar', etc.
            
            // SEO (optional)
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            
            // Author
            $table->foreignId('author_id')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes for better query performance
            $table->index('type');
            $table->index('display_type');
            $table->index('is_active');
            $table->index('priority');
            $table->index('start_date');
            $table->index('end_date');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('announcements');
    }
};
