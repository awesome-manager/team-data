<?php

namespace App\TeamData\Repositories;

use Illuminate\Database\Eloquent\{Builder, Collection};
use App\TeamData\Contracts\Repositories\GradeRepository as RepositoryContract;

class GradeRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->defaultFindRequest()->get();
    }

    public function findById(array $ids): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

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
