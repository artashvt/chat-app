<?php

namespace App\Repository\Eloquent;

use App\Models\User;
use App\Repository\UserRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{

    /**
     * UserRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->model->newQuery()
            ->verified()
            ->where('id', '<>', auth()->id())
            ->get();
    }

    /**
     * @param int $id
     * @return Model
     */
    public function findOrFail(int $id): Model
    {
        return $this->model->newQuery()
            ->verified()
            ->findOrFail($id);
    }
}
