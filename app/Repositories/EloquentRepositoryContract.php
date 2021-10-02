<?php

namespace App\Repositories;

use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentRepositoryContract
{
    /**
     * Return all paginateds
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $limit): LengthAwarePaginator;
}
