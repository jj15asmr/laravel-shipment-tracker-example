<?php

namespace Tests\Feature\Models;

use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemTest extends TestCase
{
    use RefreshDatabase;

    private Item $item;

    public function setUp(): void
    {
        parent::setUp();

        $this->item = Item::factory()->create();
    }

    /** @test */
    public function it_deletes_the_sender_and_receiver_models_when_an_item_is_deleted()
    {
        $this->item->delete();

        $this->assertModelMissing($this->item);
        $this->assertModelMissing($this->item->sender);
        $this->assertModelMissing($this->item->sender);
    }

    /** @test */
    public function it_returns_the_weight_formatted_properly_as_an_array()
    {
        $this->item->weight = 15.54; // Should calculate to 15 lbs. 9 oz.
        $this->item->save();

        $weight = $this->item->weight;

        $this->assertIsArray($weight);
        $this->assertEquals(15, $weight['pounds']);
        $this->assertEquals(9, $weight['ounces']);
    }
}
