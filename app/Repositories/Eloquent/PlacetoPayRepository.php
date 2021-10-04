<?php

namespace App\Repositories\Eloquent;

use App\Models\Order;
use App\Models\PlacetoPay;
use App\Repositories\PlacetoPayRepositoryContract;
use Carbon\Carbon;
use Dnetix\Redirection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PlacetoPayRepository extends EloquentRepository implements PlacetoPayRepositoryContract
{
    /** @var Request */
    private $request;

    function __construct(PlacetoPay $placetoPayModel)
    {
        $this->request = request();

        parent::__contruct($placetoPayModel);
    }

    /**
     * Create payment request by order instance
     * 
     * @param Order $order
     * @return array
     */
    public function createRequestPaymentByOrder(Order $order): array
    {
        return DB::transaction(function () use ($order) {
            $products = $order->products;

            $placetoPayModel = $order->placetoPays()->make([
                'locale' => 'es_CO',
                'reference' => 'ORDER_' . time(),
                'expiration' => Carbon::now()->addDays(2),
                'return_url' => route('placetoPay.successful', $order->id),
                'cancel_url' => route('placetoPay.canceled', $order->id),
                'ip_address' => $this->request->ip(),
                'user_agent' => $this->request->userAgent(),
            ]);

            $placetoPayModel->data_payment = [
                'reference' => $placetoPayModel->reference,
                'description' => __('Compra de producto(s)'),
                'amount' => [
                    'currency' => 'USD',
                    'total' => "{$products->sum('price')}",
                ],
                'items' => $products->map(fn ($item) => $item->only('sku', 'name', 'price')),
                'allowPartial' => false,
            ];

            $placetoPayModel->data_buyer = [
                'name' => $order->customer_name,
                'email' => $order->customer_email,
                'mobile' => $order->customer_mobile
            ];

            $placetoPayRedirection = new Redirection\PlacetoPay(config('placetoPay.auth'));

            $response = $placetoPayRedirection->request([
                'payment' => $placetoPayModel->data_payment,
                'buyer' => $placetoPayModel->data_buyer,
                'expiration' => $placetoPayModel->expiration,
                'returnUrl' => $placetoPayModel->return_url,
                'cancelUrl' => $placetoPayModel->cancel_url,
                'ipAddress' => $placetoPayModel->ip_address,
                'userAgent' => $placetoPayModel->user_agent,
            ]);

            if ($response->isSuccessful()) {
                $placetoPayModel->fill([
                    'request_id' => $response->requestId(),
                    'process_url' => $response->processUrl(),
                ]);

                $placetoPayModel->save();

                $statusResponse = $response->status();

                return [
                    'message' => $statusResponse->message(),
                    'date' => $statusResponse->date(),
                    'process_url' => $response->processUrl(),
                ];
            }

            dd($response->status());

            return [
                'message' => $response->status()->message(),
            ];
        });
    }
}
