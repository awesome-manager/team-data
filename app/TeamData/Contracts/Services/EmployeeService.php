<?php

namespace App\TeamData\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeService
{
    public function find(array $ids = [], bool $activeOnly = true): Collection;

    public function findAllActive(): Collection;
}
