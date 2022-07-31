<?php

namespace App\TeamData\Contracts\Services;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeService
{
    public function findAllActive(): Collection;
}
