<?php

namespace App\TeamData\Repositories;

use App\TeamData\Contracts\Repositories\PositionRepository as RepositoryContract;
use Illuminate\Database\Eloquent\{Builder, Collection};

class PositionRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->defaultFindRequest()->get();
    }

    public function findByIds(array $ids): Collection
    {
        return $this->defaultFindRequest()->find($ids);
    }

    private function defaultFindRequest(): Builder
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'title', 'code'])
            ->where('is_active', true)
            ->orderByDesc('sort');
    }
}
