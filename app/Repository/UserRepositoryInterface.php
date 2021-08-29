<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

interface UserRepositoryInterface
{
    public function all(): Collection;

    /**
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model;
}
