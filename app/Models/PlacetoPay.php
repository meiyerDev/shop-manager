<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlacetoPay extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'locale',
        'order_id',
        'request_id',
        'reference',
        'data_payment',
        'data_buyer',
        'expiration',
        'return_url',
        'cancel_url',
        'ip_address',
        'user_agent',
        'process_url',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'data_payment' => 'array',
        'data_buyer' => 'array',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'expiration',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
