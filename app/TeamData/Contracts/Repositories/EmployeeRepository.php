<?php

namespace App\TeamData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface EmployeeRepository
{
    public function findAllActive(): Collection;
}
