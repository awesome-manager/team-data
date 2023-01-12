<?php

namespace App\TeamData\Repositories;

use App\TeamData\Contracts\Repositories\VacationRepository as RepositoryContract;
use Illuminate\Database\Eloquent\{Builder, Collection};

class VacationRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->defaultFindRequest()->get();
    }

    public function findByEmployeeIds(array $employeeIds): Collection
    {
        if (empty($employeeIds)) {
            return $this->getCollection();
        }

        return $this->defaultFindRequest()
            ->whereIn('employee_id', $employeeIds)
            ->get();
    }

    private function defaultFindRequest(): Builder
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'employee_id', 'started_at', 'ended_at'])
            ->orderByDesc('started_at');
    }
}
