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
        Schema::create('technician_services', function (Blueprint $table) {

            $table->id();

            // Technician (User with Technician Role)
            $table->foreignId('technician_id')
                ->constrained('users')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            // Service
            $table->foreignId('service_id')
                ->constrained('services')
                ->restrictOnDelete()
                ->cascadeOnUpdate();

            // Custom price (Tomans)
            $table->unsignedBigInteger('custom_price')->nullable();

            // Estimated duration (minutes)
            $table->unsignedInteger('estimated_duration')->nullable();

            // Experience in years
            $table->unsignedTinyInteger('experience_years')->nullable();

            // Technician description for this service
            $table->text('description')->nullable();

            // Active / Inactive
            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // One technician can register each service only once
            $table->unique([
                'technician_id',
                'service_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_services');
    }
};
