<?php

namespace Tests\Feature\Actions;

use App\Helpers\RandomDigitsHelper;
use App\Actions\GenerateTrackingNumberAction;
use App\Enums\ItemShipmentType;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Mockery\MockInterface;
use Tests\TestCase;

class GenerateTrackingNumberActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_generates_a_tracking_number()
    {
        $generate_tracking_number = app(GenerateTrackingNumberAction::class);

        $this->assertMatchesRegularExpression(
            '/^PL\d{15}[A-Z]{3}$/m', $generate_tracking_number(ItemShipmentType::Domestic)
        );
    }

    /** @test */
    public function it_regenerates_the_tracking_number_when_it_matches_an_existing_one()
    {
        Item::factory()->create([
            'tracking_number' => 'PL100000000000000DOM'
        ]);

        // Mock our "GenerateRandomDigitsAction" class to return two sequential values, one will
        // match the item we just created and the second won't, thus the second one should be
        // used in the generating the tracking number
        $this->mock(RandomDigitsHelper::class, function (MockInterface $mock) {
            $mock->shouldReceive('__invoke')->andReturn(
                100000000000000,
                200000000000000
            );
        });

        $generate_tracking_number = app(GenerateTrackingNumberAction::class);

        $this->assertStringContainsString(
            '200000000000000', $generate_tracking_number(ItemShipmentType::Domestic)
        );
    }
}
