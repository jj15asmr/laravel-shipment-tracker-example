<?php

namespace App\Enums;

enum ItemShipmentType: string
{
    case Domestic = 'domestic';
    case International = 'international';

    /**
     * Get the three-letter abbreviation or "code" for the shipment type.
     */
    public function code(): string
    {
        return match ($this) {
            ItemShipmentType::Domestic => 'DOM',
            ItemShipmentType::International => 'INT'
        };
    }
}
