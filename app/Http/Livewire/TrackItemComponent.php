<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Livewire\Component;

class TrackItemComponent extends Component
{
    public ?string $tracking_number = null;
    public ?Item $item = null;

    protected $queryString = [
        'tracking_number' => ['as' => 'tn', 'except' => '']
    ];

    protected $rules = [
        'tracking_number' => 'required|string|regex:/^PL\d{15}[A-Z]{3}$/m',
    ];

    /**
     * When the tracking number is updated, reset the "Item" property so that it's removed
     * from the DOM.
     */
    public function updatedTrackingNumber(): void
    {
        $this->reset('item');
    }

    public function trackItem(): void
    {
        $this->validate();

        // Attempt to find the item by it's tracking number
        try {
            $this->item = Item::byTrackingNumber($this->tracking_number)->firstOrFail();

            // Emit an event with the item's tracking number and a prettified version of it's status
            // that we can use to dynamically update the tab's title
            $this->emit(
                'trackingDetailsFetched',
                $this->item->tracking_number,
                str($this->item->status->value)->replace('_', ' ')->title()
            );
            
        } catch (ModelNotFoundException $ex) {
            $this->addError('tracking_number', "We couldn't locate an item with that tracking number.");
        }
    }

    public function render()
    {
        return view('livewire.track-item-component')
                ->layout('components.layouts.main');
    }
}
