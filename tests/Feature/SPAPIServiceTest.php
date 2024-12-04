<?php

namespace Tests\Feature;

use App\Services\Interfaces\SPAPIServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;
use Tests\TestCase;

class SPAPIServiceTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test: Tests the Amazon Listings API using SPAPIService mock.
     */
    public function test_get_listings_returns_mocked_response()
    {
        $mock = $this->mock(SPAPIServiceInterface::class, function($mock) {
            $mock->shouldReceive('makeRequest')
                ->with('GET', 'listings/2021-08-01/items/seller123/sku456', [
                    'marketplaceIds' => 'ATVPDKIKX0DER',
                ])
                ->andReturn([
                    'sku' => 'SKU12345',
                    'summaries' => [
                        [
                            'marketplaceId' => 'ATVPDKIKX0DER',
                            'title' => 'Mocked Product Title',
                            'status' => 'ACTIVE',
                        ],
                    ],
                ]);
        });

        $response = $this->get('/api/amazon/listings/seller123/sku456?marketplaceIds=ATVPDKIKX0DER');

        $response->assertStatus(200);
        $response->assertJson([
            'sku' => 'SKU12345',
            'summaries' => [
                [
                    'marketplaceId' => 'ATVPDKIKX0DER',
                    'title' => 'Mocked Product Title',
                    'status' => 'ACTIVE',
                ],
            ],
        ]);
    }

    /**
     * Test: Simulates the Amazon API using Http::fake and verifies the response.
     */
    public function test_amazon_api_fake_response()
    {
        Http::fake([
            'https://sellingpartnerapi-eu.amazon.com/auth/o2/token' => Http::response([
                'access_token' => 'mock_access_token',
                'expires_in' => 3600,
                'token_type' => 'Bearer',
            ], 200),

            'https://sellingpartnerapi-eu.amazon.com/listings/2021-08-01/items/seller123/sku456*' => Http::response([
                'sku' => 'SKU12345',
                'summaries' => [
                    [
                        'marketplaceId' => 'ATVPDKIKX0DER',
                        'title' => 'Fake Product Title',
                        'status' => 'ACTIVE',
                    ],
                ],
            ], 200),
        ]);

        $service = app(SPAPIServiceInterface::class);
        $response = $service->makeRequest('GET', 'listings/2021-08-01/items/seller123/sku456', [
            'marketplaceIds' => 'ATVPDKIKX0DER',
        ]);

        $this->assertEquals('SKU12345', $response['sku']);
        $this->assertEquals('Fake Product Title', $response['summaries'][0]['title']);
    }
}
