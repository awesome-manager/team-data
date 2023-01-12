<?php

namespace App\TeamData\Services;

use App\Facades\Repository;
use Illuminate\Database\Eloquent\Collection;
use App\TeamData\Contracts\Services\EmployeeService as ServiceContract;

class EmployeeService implements ServiceContract
{
    public function find(array $ids = [], bool $activeOnly = true): Collection
    {
        if (empty($ids)) {
            if ($activeOnly) {
                $employees = Repository::employees()->findAllActive();
            } else {
                $employees = Repository::employees()->findAll();
            }
        } else {
            $employees = Repository::employees()->findByIds($ids, $activeOnly);
        }

        return tap($employees, function ($collection) {
            Repository::employees()->bindGrades($collection);
            Repository::employees()->bindPositions($collection);
        });
    }

    public function findAllActive(): Collection
    {
        return tap(Repository::employees()->findAllActive(), function ($collection) {
            Repository::employees()->bindGrades($collection);
            Repository::employees()->bindPositions($collection);
        });
    }
}
