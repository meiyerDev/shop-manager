<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class ProductApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_get_all_products()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $products = Product::factory()->count(10)->create();

        $response = $this->getJson(route('api.products.index'));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'data' => [
                    [
                        'id',
                        'name',
                        'price',
                        'created_at',
                        'updated_at'
                    ]
                ]
            ]
        ]);
        $response->assertJsonCount($products->count(), 'data.data');
    }
}
