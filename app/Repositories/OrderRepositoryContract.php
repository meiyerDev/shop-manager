<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface OrderRepositoryContract extends EloquentRepositoryContract
{
    /**
     * Create a new order
     * 
     * @param array $data
     * @param int $userId 
     */
    public function create(array $data, int $userId);

    /**
     * Return all paginateds
     * @param int $userId
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getOnlyUserPaginated(int $userId, int $limit): LengthAwarePaginator;
}
