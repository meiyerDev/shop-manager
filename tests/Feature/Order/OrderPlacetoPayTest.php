<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Http;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

use function PHPSTORM_META\map;

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

        Http::fake([
            config('placetoPay.auth.baseUrl') . 'api/session' => Http::response(
                json_decode(
                    file_get_contents(
                        base_path('tests/data/PlacetoPay/api_session_response_200.json')
                    ),
                    true
                )
            )
        ]);

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
}
