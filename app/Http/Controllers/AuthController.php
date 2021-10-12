<?php

namespace App\Http\Controllers;

use App\Http\Resources\User\UserResource;
use App\Repositories\UserRepositoryContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    /** @var UserRepositoryContract */
    private $userRepository;

    function __construct(UserRepositoryContract $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|exists:App\Models\User',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('email', 'password'), true)) {
            return $this->successResponse(
                new UserResource(Auth::user())
            );
        }

        throw ValidationException::withMessages([
            'email' => [__('These credentials do not match our records.')]
        ]);
    }
}
