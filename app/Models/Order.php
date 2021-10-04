<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;

    const STATUS_CREATED = 'CREATED';
    const STATUS_PAYED = 'PAYED';
    const STATUS_REJECTED = 'REJECTED';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'status',
        'code',
        'customer_name',
        'customer_email',
        'customer_mobile'
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        parent::creating(function ($model) {
            $model->code ??= Str::uuid()->toString();
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class)
            ->withTimestamps();;
    }

    public function placetoPays()
    {
        return $this->hasMany(PlacetoPay::class);
    }

    # Scopes
    public function scopeOnlyUser($query, int $userId)
    {
        return $query->where('user_id', $userId);
    }

    # Assesors
    public function getAmountTotalAttribute()
    {
        return $this->products->sum('price');
    }

    # Methods
    public function latestPlacetoPay()
    {
        return $this->placetoPays->last();
    }

    public function findPlacetoPlayByReferenceId(string $referenceId)
    {
        return $this->placetoPays->firstWhere('reference', $referenceId);
    }
}
