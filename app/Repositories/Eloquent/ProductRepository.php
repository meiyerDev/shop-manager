<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Repositories\ProductRepositoryContract;

class ProductRepository extends EloquentRepository implements ProductRepositoryContract
{
    function __construct(Product $model)
    {
        parent::__contruct($model);
    }
}
