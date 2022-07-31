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

    public function bindGrades(Collection $employees): Collection
    {
        return $employees->load('grade:id,title,code');
    }

    public function bindPositions(Collection $employees): Collection
    {
        return $employees->load('position:id,title,code');
    }
}
