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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('module'); // e.g., 'procurement', 'publications'
            $table->string('action'); // e.g., 'view', 'create', 'edit', 'delete'
            $table->string('name')->unique(); // e.g., 'procurement.create'
            $table->string('description')->nullable();
            $table->timestamps();

            // Add index for faster lookups
            $table->index(['module', 'action']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
