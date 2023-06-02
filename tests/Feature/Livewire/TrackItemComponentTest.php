<?php

namespace Tests\Feature\Livewire;

use App\Enums\ItemStatus;
use App\Http\Livewire\TrackItemComponent;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TrackItemComponentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_loads_the_route_with_the_component()
    {
        $this->get('/track')

            ->assertSeeLivewire(TrackItemComponent::class)
            ->assertSee('Track Your Item');
    }

    /** @test */
    public function it_allows_us_to_track_an_item_and_shows_the_proper_data()
    {
        $item = Item::factory()->create([
            'shipment_type' => 'domestic',
            'weight' => 15.54,
            'status' => 'picked_up',
            'shipped_on' => '2023-05-31'
        ]);

        Livewire::test(TrackItemComponent::class)
            ->set('tracking_number', $item->tracking_number)
            ->call('trackItem')

            ->assertSeeText("Tracking details for {$item->tracking_number}")

            ->assertSeeHtmlInOrder([
                'Picked Up',

                'Sender:',
                nl2br($item->sender->address_formatted),

                'Receiver:',
                nl2br($item->receiver->address_formatted),

                'Shipped On:',
                '5/31/2023',

                'Type:',
                'DOMESTIC',

                'Weight:',
                '15 lbs. 9 oz.',

                'Events:',
                $item->events->first()->location,
                $item->events->first()->details
            ]);
    }

    /** @test */
    public function it_shows_a_detailed_alert_when_the_tracking_numbers_format_is_invalid()
    {
        Livewire::test(TrackItemComponent::class)
            ->set('tracking_number', 'PL433961012306775INTL') // Contains extra letter for type code :)
            ->call('trackItem')

            ->assertHasErrors('tracking_number')
            ->assertSeeHtml("Hmm, that doesn't look like a proper PoŝtaLoĝistiko tracking number.");
    }

    /** @test */
    public function it_shows_an_alert_instead_of_the_tracking_progress_bar_when_the_item_status_is_in_system()
    {
        $item = Item::factory()->create([
            'status' => ItemStatus::InSystem
        ]);

        Livewire::test(TrackItemComponent::class)
            ->set('tracking_number', $item->tracking_number)
            ->call('trackItem')

            ->assertSee('This item is in our system but not yet within our custody')
            ->assertDontSee('tracking-progress-wrapper');
    }
}
