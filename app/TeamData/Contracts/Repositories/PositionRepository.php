<?php

namespace App\TeamData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface PositionRepository
{
    public function findAllActive(): Collection;

    public function findByIds(array $ids): Collection;
}
