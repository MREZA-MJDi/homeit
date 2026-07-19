<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')
                ->constrained('service_categories')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('title', 150);

            $table->string('slug', 180)->unique();

            $table->string('short_description')->nullable();

            $table->longText('description')->nullable();

            $table->enum('price_type', [
                'fixed',
                'hourly',
                'quote'
            ]);

            $table->decimal('base_price', 10, 2)->nullable();
            $table->unsignedInteger('duration')->nullable()->comment('Duration in minutes');            $table->string('image')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
            $table->index('price_type');
            $table->index('is_active');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
