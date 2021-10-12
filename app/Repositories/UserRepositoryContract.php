<?php

namespace App\Repositories;

use App\Models\User;

interface UserRepositoryContract extends EloquentRepositoryContract
{
    /**
     * Find user by email
     */
    public function findByEmail(string $email): User;
}
