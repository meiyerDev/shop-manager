<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'sku',
        'name',
        'price'
    ];

    public function orders()
    {
        return $this->belongsToMany(Order::class)
            ->withTimestamps();
    }
}
