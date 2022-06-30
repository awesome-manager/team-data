<?php

namespace App\TeamData\Repositories;

use App\TeamData\Contracts\Repositories;
use App\TeamData\Contracts\Repositories\Repository as RepositoryContract;

class Repository implements RepositoryContract
{
    public function grades(): Repositories\GradeRepository
    {
        return app(Repositories\GradeRepository::class);
    }

    public function positions(): Repositories\PositionRepository
    {
        return app(Repositories\PositionRepository::class);
    }
}
