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
                return Repository::employees()->findAllActive();
            } else {
                return Repository::employees()->findAll();
            }
        } else {
            return Repository::employees()->findByIds($ids, $activeOnly);
        }
    }

    public function findAllActive(): Collection
    {
        return tap(Repository::employees()->findAllActive(), function ($collection) {
            Repository::employees()->bindGrades($collection);
            Repository::employees()->bindPositions($collection);
        });
    }
}
