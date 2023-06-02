<?php

namespace Tests\Feature\Models;

use App\Models\ItemAddress;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ItemAddressTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     * @dataProvider addressProvider
     */
    public function it_returns_the_address_formatted_properly(
        string $expected_format,
        string $name,
        string $street,
        string $municipality,
        string $country,
        string $region = null,
        string $postal_code = null
    )
    {
        $address_args = get_defined_vars();
        unset($address_args['expected_format']);

        $item_address = ItemAddress::factory()->create($address_args);

        $this->assertEquals($expected_format, $item_address->address);
    }

    private function addressProvider(): array
    {
        return [
            'full address' => [
                <<<END
                James E. Burdett
                2535 Trymore Road
                Manchester, Minnesota 56064, United States
                END,

                'James E. Burdett',
                '2535 Trymore Road',
                'Manchester',
                'United States',
                'Minnesota',
                '56064'
            ],

            'address with null region' => [
                <<<END
                James E. Burdett
                2535 Trymore Road
                Manchester, 56064, United States
                END,

                'James E. Burdett',
                '2535 Trymore Road',
                'Manchester',
                'United States',
                null,
                '56064'
            ],

            'address with null postal code' => [
                <<<END
                James E. Burdett
                2535 Trymore Road
                Manchester, Minnesota, United States
                END,

                'James E. Burdett',
                '2535 Trymore Road',
                'Manchester',
                'United States',
                'Minnesota',
                null
            ],

            'address with null region and postal code' => [
                <<<END
                James E. Burdett
                2535 Trymore Road
                Manchester, United States
                END,

                'James E. Burdett',
                '2535 Trymore Road',
                'Manchester',
                'United States',
                null,
                null
            ]
        ];
    }
}
