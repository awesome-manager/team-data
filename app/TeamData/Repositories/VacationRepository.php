<?php

namespace App\TeamData\Repositories;

use Illuminate\Database\Eloquent\Collection;
use App\TeamData\Contracts\Repositories\VacationRepository as RepositoryContract;

class VacationRepository extends AbstractRepository implements RepositoryContract
{
    public function findAllActive(): Collection
    {
        return $this->getModel()->newQuery()
            ->select(['id', 'employee_id', 'started_at', 'ended_at'])
            ->with('employee:id,name,surname,position_id')
            ->orderByDesc('started_at')
            ->get();
    }
}
