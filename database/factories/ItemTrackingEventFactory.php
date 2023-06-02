<?php

namespace Database\Factories;

use App\Models\Item;
use App\Enums\ItemStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ItemTrackingEvent>
 */
class ItemTrackingEventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_id' => Item::factory(state: ['status' => ItemStatus::InTransit]),
            
            'location_municipality' => fake()->city(),
            'location_region' => fake()->boolean() ? fake()->state() : null,
            'location_country' => fake()->countryCode(),
            'details' => str(fake()->sentence())->remove('.'),

            'occurred_at' => fake()->dateTimeThisYear()
        ]; 
    }
}
