<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryContract;

class UserRepository extends EloquentRepository implements UserRepositoryContract
{
    function __construct(User $user)
    {
        parent::__contruct($user);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }
}
