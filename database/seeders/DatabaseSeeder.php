<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Item;
use App\Enums\ItemStatus;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Item::factory(6)
            ->sequence(
                ['status' => ItemStatus::InSystem],
                ['status' => ItemStatus::PickedUp],
                ['status' => ItemStatus::InTransit],
                ['status' => ItemStatus::Dispatched],
                ['status' => ItemStatus::Delivered],
            )
            ->create();
    }
}
