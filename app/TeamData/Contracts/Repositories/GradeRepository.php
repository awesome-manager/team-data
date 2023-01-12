<?php

namespace App\TeamData\Contracts\Repositories;

use Illuminate\Database\Eloquent\Collection;

interface GradeRepository
{
    public function findAllActive(): Collection;

    public function findById(array $ids): Collection;
}
