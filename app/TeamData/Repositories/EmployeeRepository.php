<?php

namespace App\TeamData\Repositories;

use App\TeamData\Contracts\Repositories\EmployeeRepository as RepositoryContract;
use Illuminate\Database\Eloquent\{Builder, Collection};

class EmployeeRepository extends AbstractRepository implements  RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->defaultFindRequest()->get();
    }

    public function findAll(): Collection
    {
        return $this->defaultFindRequest(false)->get();
    }

    public function findByIds(array $ids, bool $activeOnly = true): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->defaultFindRequest($activeOnly)->find($ids);
    }

    public function bindGrades(Collection $employees): Collection
    {
        return $employees->load('grade:id,title,code');
    }

    public function bindPositions(Collection $employees): Collection
    {
        return $employees->load('position:id,title,code');
    }

    private function defaultFindRequest(bool $activeOnly = true): Builder
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'name', 'surname', 'position_id', 'grade_id', 'employment_at', 'probation'])
            ->when($activeOnly, function ($query) {
                return $query->where('is_active', true);
            })
            ->orderBy('name');
    }
}
