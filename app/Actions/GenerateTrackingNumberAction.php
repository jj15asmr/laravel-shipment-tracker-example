<?php

namespace App\Actions;

use App\Enums\ItemShipmentType;
use App\Helpers\RandomDigitsHelper;
use App\Models\Item;

class GenerateTrackingNumberAction
{
    public function __construct(
        private RandomDigitsHelper $random_digits_helper
    ) {}

    /**
     * Generate a unique tracking number for an item.
     */
    public function __invoke(ItemShipmentType $type): string
    {
        do {
            $identifier = ($this->random_digits_helper)(15);
            $tracking_number = "PL{$identifier}{$type->code()}";

        } while ($this->trackingNumberExists($tracking_number));

        return $tracking_number;
    }

    /**
     * Check if a tracking number already exists (is in use).
     */
    private function trackingNumberExists(string $tracking_number): bool
    {
        return Item::where('tracking_number', $tracking_number)->exists();
    }
}
