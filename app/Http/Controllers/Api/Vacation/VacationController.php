<?php

namespace App\Http\Controllers\Api\Vacation;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Exceptions\VacationsNotFound;
use App\Http\Resources\Api\Vacation\VacationsResource;

class VacationController extends Controller
{
    public function findVacations()
    {
        $vacations = Repository::vacations()->findAllActive();

        if ($vacations->isEmpty()) {
            throw new VacationsNotFound('Не найдено ни одного отпуска');
        }

        $employees = Repository::employees()->findByIds(
            $vacations->pluck('employee_id')->unique()->all()
        );

        return response()->jsonResponse(
            (new VacationsResource(collect(compact('vacations', 'employees'))))->toArray()
        );
    }
}
