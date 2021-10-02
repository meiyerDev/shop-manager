<?php

namespace App\Http\Requests\Order;

use Illuminate\Foundation\Http\FormRequest;

class CreateOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'customer_name' => 'required|string|min:3|max:255',
            'customer_email' => 'required|email',
            'customer_mobile' => 'required|string|max:50',
            'product_id' => 'required|exists:App\Models\Product,id',
        ];
    }
}
