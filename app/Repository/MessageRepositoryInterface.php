<?php

namespace App\Repository;

use Illuminate\Database\Eloquent\Model;

interface MessageRepositoryInterface
{
    /**
     * @param array $data
     * @return array
     */
    public function get(array $data): array;

    /**
     * @param array $attributes
     * @return array
     */
    public function create(array $attributes): array;
}
