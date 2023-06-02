<?php

namespace App\Enums;

enum ItemStatus: string
{
    case InSystem = 'in_system';
    case PickedUp = 'picked_up';
    case InTransit = 'in_transit';
    case Dispatched = 'dispatched';
    case Delivered = 'delivered';

    /**
     * Check if the current status' value matches the value passed in.
     */
    public function isCurrentStatus(string $status_value): bool
    {
        return $this->value == $status_value;
    }

    /**
     * Check if status value passed in comes before the current one (a previous status).
     */
    public function isPreviousStatus(string $status_value): bool
    {
        // Create an array of status values
        $statuses = array_column(ItemStatus::cases(), 'value');

        $passed_in_status = array_search($status_value, $statuses);
        $current_status = array_search($this->value, $statuses);

        // Check if the index of the passed status is less than that of the current status
        if ($passed_in_status !== false && $current_status !== false) {
			return $passed_in_status < $current_status;
		}
	
		return false;
    }
}
