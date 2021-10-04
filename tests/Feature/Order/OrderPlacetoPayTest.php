<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use App\Models\PlacetoPay;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrderPlacetoPayTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create a request pay by order id.
     *
     * @return void
     */
    public function test_create_a_request_pay_by_order_id()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $order = Order::factory()
            ->for($user)
            ->hasProducts()
            ->create();

        $response = $this->postJson(route('api.order.placeto-pay.generate', $order->id));

        $response->assertCreated();
        $response->assertJsonStructure([
            'data' => [
                'message',
                'date',
                'process_url',
            ]
        ]);

        $this->assertDatabaseHas('placeto_pays', [
            'order_id' => $order->id
        ]);
    }

    /**
     * Update placetoPay status by reference
     */
    public function test_update_status_by_reference()
    {
        $placetoPayModel = PlacetoPay::factory()->create();
        $user = $placetoPayModel->order->user;
        Sanctum::actingAs($user);

        $response = $this->post($placetoPayModel->return_url);

        $response->assertRedirect(route('web.placeto-pay.successful', $placetoPayModel->order_id));
        $this->assertDatabaseHas('orders', [
            'id' => $placetoPayModel->order_id,
            'status' => Order::STATUS_PAYED
        ]);
    }

    /**
     * Update placetoPay status by reference fail by reference not found
     */
    public function test_update_status_by_reference_fail_by_reference_not_found()
    {
        $placetoPayModel = PlacetoPay::factory()->create([
            'request_id' => 90000
        ]);
        $user = $placetoPayModel->order->user;
        Sanctum::actingAs($user);

        $response = $this->post($placetoPayModel->return_url);

        $response->assertRedirect(route('web.placeto-pay.retry', ['orderId' => $placetoPayModel->order_id, 'reason' => 'failed']));
        $this->assertDatabaseHas('orders', [
            'id' => $placetoPayModel->order_id,
            'status' => Order::STATUS_CREATED
        ]);
    }
}
