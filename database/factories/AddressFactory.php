<?php

namespace Database\Factories;

use App\Models\Address;
use App\Models\City;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'city_id' => function (array $attributes) {
                return User::find($attributes['user_id'])->city_id;
            },
            'label' => fake()->randomElement([
                'خانه',
                'محله کار',
                'دفتر'
            ]),
            'receiver_name' => fake()->name(),
            'receiver_mobile' => fake()->numerify('09#########'),

            'address' => fake()->streetAddress(),

            'plaque' => fake()->buildingNumber(),

            'unit' => fake()->optional()->numberBetween(1, 20),

            'postal_code' => fake()->postcode(),

            'is_default' => fake()->boolean(),
        ];
    }
}
