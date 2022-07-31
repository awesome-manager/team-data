<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;
use App\TeamData\Contracts\Repositories;
use App\TeamData\Contracts\Repositories\Repository as RepositoryContract;

/**
 * @method static Repositories\GradeRepository grades()
 * @method static Repositories\PositionRepository positions()
 * @method static Repositories\EmployeeRepository employees()
 */
class Repository extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return RepositoryContract::class;
    }
}
