<?php

namespace App\Repositories;

interface OrderRepositoryContract extends EloquentRepositoryContract
{
    /**
     * Create a new order
     * 
     * @param array $data
     * @param int $userId 
     */
    public function create(array $data, int $userId);
}
