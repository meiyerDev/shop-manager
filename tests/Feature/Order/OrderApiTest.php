<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderApiTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /**
     * Create an order.
     *
     * @return void
     */
    public function test_post_to_create_order()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $product = Product::factory()->create();
        $data = [
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email(),
            'customer_mobile' => $this->faker->phoneNumber(),
            'product_id' => $product->id,
        ];

        $response = $this->postJson('/order', $data);

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'code',
                'customer_name',
                'customer_email',
                'customer_mobile',
                'products' => [
                    [
                        'id',
                        'name',
                        'price'
                    ]
                ]
            ]
        ]);

        $this->assertDatabaseHas('orders',  [
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_mobile' => $data['customer_mobile'],
            'user_id' => $user->id
        ]);
        $this->assertDatabaseHas('order_product', [
            'product_id' => $product->id
        ]);
    }

    /**
     * Create an order fail by unauthorized.
     *
     * @return void
     */
    public function test_post_to_create_order_fail_by_unauthorized()
    {
        $product = Product::factory()->create();
        $data = [
            'customer_name' => $this->faker->name,
            'customer_email' => $this->faker->email(),
            'customer_mobile' => $this->faker->phoneNumber(),
            'product_id' => $product->id,
        ];

        $response = $this->postJson('/order', $data);
        $response->assertUnauthorized();

        $this->assertDatabaseMissing('orders',  [
            'customer_name' => $data['customer_name'],
            'customer_email' => $data['customer_email'],
            'customer_mobile' => $data['customer_mobile'],
        ]);
        $this->assertDatabaseMissing('order_product', [
            'product_id' => $product->id
        ]);
    }

    /**
     * Create an order fail by validations.
     *
     * @return void
     */
    public function test_post_to_create_order_fail_by_validations()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $data = [];

        $response = $this->postJson('/order', $data);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'customer_name',
            'customer_email',
            'customer_mobile',
            'product_id',
        ], 'error');

        $this->assertDatabaseCount('orders', 0);
    }

    /**
     * Return an order data
     * 
     * @return void
     */
    public function test_get_order_data_by_id()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $order = Order::factory()
            ->for($user)
            ->hasProducts()
            ->create();

        $response = $this->getJson("/order/{$order->id}");

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'code',
                'customer_name',
                'customer_email',
                'customer_mobile',
                'status',
                'products' => [
                    [
                        'id',
                        'name',
                        'price'
                    ]
                ]
            ]
        ]);
    }

    /**
     * Return an order data fail by forbidden
     * 
     * @return void
     */
    public function test_get_order_data_by_id_fail_by_forbidden()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $order = Order::factory()
            ->forUser()
            ->hasProducts()
            ->create();

        $response = $this->getJson("/order/{$order->id}");

        $response->assertForbidden();
    }
}
