<?php

namespace App\Http\Controllers\Api\Vacation;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Vacation\VacationsResource;

class VacationController extends Controller
{
    public function findVacations()
    {
        $vacations = Repository::vacations()->findAllActive();

        $positions = Repository::positions()->findByIds(
            $vacations->pluck('employee.position_id')->unique()->all()
        );

        return (new VacationsResource(collect(compact('vacations', 'positions'))))->toArray();
    }
}
