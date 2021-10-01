<?php

namespace Tests\Feature\Product;

use App\Models\Product;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ProductRelationshipsTest extends TestCase
{
    /**
     * Product instance belongs to many orders.
     *
     * @return void
     */
    public function test_product_belongs_to_many_orders()
    {
        $product = new Product;
        $this->assertInstanceOf(BelongsToMany::class, $product->orders());
    }
}
