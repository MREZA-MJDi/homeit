<?php

namespace Database\Factories;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TechnicianServiceFactory extends Factory
{
    public function definition(): array
    {
        return [
            'technician_id' => User::factory(),
            'service_id' => Service::factory(),
            'custom_price' => fake()->numberBetween(150000, 1500000),
            'estimated_duration' => fake()->numberBetween(30, 240),
            'experience_years' => fake()->numberBetween(1, 15),
            'description' => fake()->sentence(),
            'is_active' => true,
        ];
    }
}
