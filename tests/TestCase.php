<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function createUserClient()
    {
        return User::factory()->create();
    }

    protected function createUserAdmin()
    {
        return User::factory()->create([
            'is_admin' => true
        ]);
    }
}
