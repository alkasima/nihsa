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
        Schema::create('flood_data', function (Blueprint $table) {
            $table->id();
            $table->string('state');
            $table->string('lga');
            $table->string('community')->nullable();
            $table->string('risk_level'); // High, Moderate, Low
            $table->string('flood_type')->default('Riverine'); // Riverine, Flash/Urban, Coastal
            $table->date('forecast_date');
            $table->text('description')->nullable();
            $table->decimal('latitude', 10, 7)->nullable();
            $table->decimal('longitude', 10, 7)->nullable();
            $table->integer('year');
            $table->string('period'); // AMJ, JAS, ON (Apr-May-Jun, Jul-Aug-Sep, Oct-Nov)
            $table->integer('probability')->nullable(); // 0-100%
            $table->integer('affected_population')->nullable();
            $table->decimal('affected_area', 10, 2)->nullable(); // in km²
            $table->decimal('expected_rainfall', 8, 2)->nullable(); // in mm
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flood_data');
    }
};
