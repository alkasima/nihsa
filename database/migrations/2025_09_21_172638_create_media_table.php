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
        Schema::create('media - 2025_09_21_172638_create_media_table.php:14', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file_path');
            $table->enum('media_type', ['image', 'video', 'document']);
            $table->string('mime_type');
            $table->integer('file_size')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->json('metadata')->nullable(); // For additional info like dimensions, duration, etc.
            $table->boolean('is_featured')->default(false);
            $table->integer('sort_order')->default(0);
            $table->string('category')->default('general'); // photos, videos, documents, etc.
            $table->timestamps();

            $table->index(['media_type', 'category']);
            $table->index('is_featured');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
