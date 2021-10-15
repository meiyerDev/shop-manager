<?php

namespace Tests\Feature\User;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRelationshipsTest extends TestCase
{
    /**
     * user instance has many orders
     * 
     * @return void
     */
    public function test_user_has_many_orders()
    {
        $user = new User;
        $this->assertInstanceOf(HasMany::class, $user->orders());
    }
}
