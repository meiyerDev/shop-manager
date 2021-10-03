<?php

namespace Tests\Feature\Order;

use App\Models\Order;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderRelationshipsTest extends TestCase
{
    /**
     * Order instance belongs to user.
     *
     * @return void
     */
    public function test_order_belongs_to_user()
    {
        $order = new Order;
        $this->assertInstanceOf(BelongsTo::class, $order->user());
    }

    /**
     * Order instansce belongs to many products
     * 
     * @return void
     */
    public function test_order_belongs_to_many_products()
    {
        $order = new Order;
        $this->assertInstanceOf(BelongsToMany::class, $order->products());
    }

    /**
     * Order instansce has many Placeto Pays
     * 
     * @return void
     */
    public function test_order_has_many_placeto_pays()
    {
        $order = new Order;
        $this->assertInstanceOf(HasMany::class, $order->placetoPays());
    }
}
