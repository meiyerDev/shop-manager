<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\PlacetoPay;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class PlacetoPayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = PlacetoPay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $order = Order::factory()->create();
        $reference = 'ORDER_' . time();
        $dataToRoutes = ['orderId' => $order->id, 'referenceId' => $reference];

        return [
            'locale' => 'es_CO',
            'reference' => $reference,
            'expiration' => Carbon::now()->addDays(2),
            'return_url' => route('api.order.placeto-pay.successful', $dataToRoutes),
            'cancel_url' => route('api.order.placeto-pay.canceled', $dataToRoutes),
            'ip_address' => $this->faker->ipv4(),
            'user_agent' => $this->faker->userAgent(),
            'data_payment' => '',
            'data_buyer' => '',
            'order_id' => $order->id,
            'request_id' => $this->faker->numberBetween(10008, 10010),
            'process_url' => $this->faker->url()
        ];
    }
}
