<?php

namespace App\TeamData\Repositories;

use App\TeamData\Contracts\Repositories;
use Illuminate\Database\Eloquent\Collection;
use App\TeamData\Contracts\Repositories\GradeRepository as RepositoryContract;

class GradeRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select(['title', 'code'])
            ->where('is_active', true)
            ->orderByDesc('sort')
            ->get();
    }
}
