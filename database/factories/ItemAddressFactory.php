<?php

namespace Database\Factories;

use App\Enums\ItemStatus;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemAddress>
 */
class ItemAddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->boolean() ? fake()->name() : fake()->company(),
            'street' => fake()->streetAddress(),
            'municipality' => fake()->city(),
            'region' => fake()->boolean() ? fake()->state() : null,
            'postal_code' => fake()->boolean() ? fake()->postcode() : null,
            'country' => fake()->country()
        ];
    }
}
