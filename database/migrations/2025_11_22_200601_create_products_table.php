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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('short_description')->nullable();
            $table->text('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable(); // gallery
            $table->decimal('price', 10, 2)->nullable();
            $table->string('price_range')->nullable(); // e.g., "$50 - $100"
            $table->boolean('show_price')->default(true);
            $table->json('specifications')->nullable();
            $table->json('downloads')->nullable(); // brochures, PDFs
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('og_image')->nullable();
            $table->boolean('published')->default(false);
            $table->boolean('featured')->default(false);
            $table->integer('stock')->nullable();
            $table->integer('order')->default(0);
            $table->foreignId('created_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
