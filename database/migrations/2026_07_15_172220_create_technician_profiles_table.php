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
        Schema::create('technician_profiles', function (Blueprint $table) {

            $table->id();

            $table->foreignId('user_id')
                ->unique()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            // Profile image
            $table->string('avatar')->nullable();

            // Biography
            $table->text('bio')->nullable();

            // National Code
            $table->string('national_code', 10)->nullable();

            // IBAN
            $table->string('iban', 34)->nullable();

            // Ready to receive new orders?
            $table->boolean('is_available')->default(true);

            // Vacation end date
            $table->date('vacation_until')->nullable();

            // Verified by admin
            $table->boolean('is_verified')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('technician_profiles');
    }
};
