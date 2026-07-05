<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => fake()->firstName(),
            'last_name' => fake()->lastName(),
            'mobile' => fake()->unique()->numerify('09########'),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'avatar' => null,
            'mobile_verified_at' => now(),
            'gender' => fake()->randomElement([1, 2]),
            'is_active' => true,
            'city_id' => City::factory(),
            'last_login_at' => now(),
            'password' => 'password',
            'remember_token' => fake()->regexify('[A-Za-z0-9]{10}'),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn(array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
