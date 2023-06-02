<?php

namespace Tests\Feature\Models;

use App\Models\ItemTrackingEvent;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTrackingEventTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider locationProvider
     */
    public function it_returns_the_location_formatted_properly(
        string $expected_format,
        string $municipality,
        string $country,
        string $region = null
    )
    {
        $item_tracking_event = ItemTrackingEvent::factory()->create([
            'location_municipality' => $municipality,
            'location_region' => $region,
            'location_country' => $country
        ]);

        $this->assertEquals($expected_format, $item_tracking_event->location);
    }

    private function locationProvider(): array
    {
        return [
            'full location' => [
                'LAKE REYESVIEW, ILLINOIS, US',

                'Lake Reyesview',
                'US',
                'Illinois'
            ],

            'location with null region' => [
                'LAKE REYESVIEW, US',

                'Lake Reyesview',
                'US',
                null
            ]
        ];
    }

    /** @test */
    public function it_returns_the_details_in_all_uppercase()
    {
        $item_tracking_event = ItemTrackingEvent::factory()->create([
            'details' => 'i am all lowercase'
        ]);

        $this->assertEquals('I AM ALL LOWERCASE', $item_tracking_event->details);
    }
}
