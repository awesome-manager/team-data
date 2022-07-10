<?php

namespace App\TeamData\Services;

use App\Facades\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\TeamData\Contracts\Services\EmployeeService as ServiceContract;

class EmployeeService implements ServiceContract
{
    public function findAllActive(): Collection
    {
        return tap(Repository::employees()->findAllActive(), function ($collection) {
            Repository::employees()->bindGrades($collection);
            Repository::employees()->bindPositions($collection);
        });
    }
}
