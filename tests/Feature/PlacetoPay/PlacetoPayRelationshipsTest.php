<?php

namespace Tests\Feature\PlacetoPay;

use App\Models\PlacetoPay;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PlacetoPayRelationshipsTest extends TestCase
{
    /**
     * Placeto Pay instance belongs to order.
     *
     * @return void
     */
    public function test_placeto_pay_belongs_to_order()
    {
        $placetoPay = new PlacetoPay;
        $this->assertInstanceOf(BelongsTo::class, $placetoPay->order());
    }
}
