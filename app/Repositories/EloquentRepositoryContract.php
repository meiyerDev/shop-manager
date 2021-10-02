<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;

interface EloquentRepositoryContract
{
    /**
     * Return all paginateds
     * @param int $limit
     * @return LengthAwarePaginator
     */
    public function getAllPaginated(int $limit): LengthAwarePaginator;

    /**
     * Find data by primary key or fail
     * 
     * @param int $primary
     * @return Model
     * @throws ModelNotFoundException
     */
    public function findOrFail(int $primary): Model;
}
