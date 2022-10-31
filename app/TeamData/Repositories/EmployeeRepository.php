<?php

namespace App\TeamData\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\TeamData\Contracts\Repositories\EmployeeRepository as RepositoryContract;

class EmployeeRepository extends AbstractRepository implements  RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'name', 'surname', 'position_id', 'grade_id', 'employment_at', 'probation'])
            ->where('is_active', true)
            ->orderBy('name')
            ->get();
    }

    public function findByIds(array $ids, bool $activeOnly = true): Collection
    {
        if (empty($ids)) {
            return $this->getCollection();
        }

        return $this->getModel()->newQuery()
            ->select(['id', 'name', 'surname', 'position_id', 'grade_id', 'employment_at', 'probation'])
            ->when($activeOnly, function ($query) {
                return $query->where('is_active', true);
            })
            ->orderBy('name')
            ->find($ids);
    }

    public function bindGrades(Collection $employees): Collection
    {
        return $employees->load('grade:id,title,code');
    }

    public function bindPositions(Collection $employees): Collection
    {
        return $employees->load('position:id,title,code');
    }
}
