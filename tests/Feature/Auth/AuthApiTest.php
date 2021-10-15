<?php

namespace Tests\Feature\Auth;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test login successful.
     *
     * @return void
     */
    public function test_login_successful()
    {
        $user = $this->createUserClient();

        $response = $this->postJson(route('api.auth.login'), [
            'email' => $user->email,
            'password' => 'password'
        ]);

        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id',
                'name',
                'email',
                'is_admin',
            ]
        ]);
    }

    /**
     * Test login fail by validations.
     *
     * @return void
     */
    public function test_login_fail_by_validations()
    {
        $response = $this->postJson(route('api.auth.login'), []);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'email',
            'password',
        ], 'error');
    }

    /**
     * Test login fail by validations.
     *
     * @return void
     */
    public function test_login_fail_by_credentials()
    {
        $user = $this->createUserClient();

        $response = $this->postJson(route('api.auth.login'), [
            'email' => $user->email,
            'password' => 'passwords'
        ]);

        $response->assertUnprocessable();
        $response->assertJsonValidationErrors([
            'email',
        ], 'error');
    }

    /**
     * Test get user authenticated
     * 
     * @return void
     */
    public function test_get_user_authenticated()
    {
        $user = $this->createUserClient();
        Sanctum::actingAs($user);

        $response = $this->getJson(route('api.auth.get-auth'));
        $response->assertOk();
        $response->assertJsonStructure([
            'data' => [
                'id', 'name', 'email', 'is_admin'
            ]
        ]);
    }

    /**
     * Test get user authenticated
     * 
     * @return void
     */
    public function test_get_user_authenticated_fail_by_unauthorized()
    {
        $response = $this->getJson(route('api.auth.get-auth'));
        $response->assertUnauthorized();
    }
}
