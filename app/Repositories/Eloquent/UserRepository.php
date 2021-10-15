<?php

namespace App\Repositories\Eloquent;

use App\Models\User;
use App\Repositories\UserRepositoryContract;
use Illuminate\Contracts\Hashing\Hasher;
use Illuminate\Support\Facades\DB;

class UserRepository extends EloquentRepository implements UserRepositoryContract
{
    /** @var Hasher */
    private $hasher;

    function __construct(User $user, Hasher $hasher)
    {
        $this->hasher = $hasher;

        parent::__contruct($user);
    }

    /**
     * Find user by email
     */
    public function findByEmail(string $email): User
    {
        return $this->model->where('email', $email)->firstOrFail();
    }

    /**
     * Create user by array
     * @param array $user
     */
    public function create(array $data): User
    {
        return DB::transaction(function () use ($data) {
            return $this->model->create(array_merge(
                $data,
                [
                    'password' => $this->hasher->make($data['password']),
                ]
            ));
        });
    }
}
