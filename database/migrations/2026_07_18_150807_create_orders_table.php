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
        Schema::create('orders', function (Blueprint $table) {

            $table->id();

            $table->foreignId('customer_id')
                ->constrained('users')
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->foreignId('assigned_technician_id')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('assigned_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->foreignId('address_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->restrictOnDelete();

            $table->string('status')
                ->default('pending');

            $table->decimal('subtotal', 12, 2);

            $table->decimal('discount_amount', 12, 2)
                ->default(0);

            $table->decimal('total_price', 12, 2);

            $table->string('currency')
                ->default('IRR');

            $table->string('payment_status')
                ->default('pending');

            $table->timestamp('requested_at');

            $table->timestamp('assigned_at')
                ->nullable();

            $table->timestamp('accepted_at')
                ->nullable();

            $table->timestamp('started_at')
                ->nullable();

            $table->timestamp('completed_at')
                ->nullable();

            $table->timestamp('cancelled_at')
                ->nullable();
            $table->timestamp('on_the_way_at')->nullable();

            $table->foreignId('cancelled_by')
                ->nullable()
                ->constrained('users')
                ->cascadeOnUpdate()
                ->nullOnDelete();

            $table->text('cancel_reason')
                ->nullable();

            $table->text('customer_note')
                ->nullable();

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
