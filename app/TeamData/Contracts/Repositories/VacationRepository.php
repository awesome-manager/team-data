<?php

namespace App\TeamData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface VacationRepository
{
    public function findAllActive(): Collection;
}
