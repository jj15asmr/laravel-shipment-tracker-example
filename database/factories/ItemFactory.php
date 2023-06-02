<?php

namespace Database\Factories;

use App\Actions\GenerateTrackingNumberAction;
use App\Enums\{ItemShipmentType, ItemStatus};
use App\Models\{Item, ItemAddress, ItemTrackingEvent};
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Configure the model factory.
     */
    public function configure(): static
    {
        return $this->afterCreating(function (Item $item) {
            // If the item's status is other than "in_system" add up to 12 tracking events
            if ($item->status !== ItemStatus::InSystem) {
                ItemTrackingEvent::factory(mt_rand(1, 12))->create([
                    'item_id' => $item->id
                ]);
            }
        });
    }

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $generate_tracking_number = app(GenerateTrackingNumberAction::class);
        $shipment_type = fake()->randomElement(ItemShipmentType::class);

        return [
            'tracking_number' => $generate_tracking_number($shipment_type),

            'sender_address_id' => ItemAddress::factory(),
            'receiver_address_id' => ItemAddress::factory(),

            'shipment_type' => $shipment_type,
            'weight' => fake()->randomFloat(2, 0, 100),
            'status' => ItemStatus::InTransit,

            'shipped_on' => function(array $attrs) {
                return ($attrs['status'] !== ItemStatus::InSystem) ? fake()->dateTimeThisMonth()->format('Y-m-d') : null;
            },
            'created_at' => fake()->dateTimeThisMonth()
        ];
    }
}
