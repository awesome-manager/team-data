<?php

namespace App\Http\Controllers\Api\Vacation;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Exceptions\VacationsNotFound;
use Awesome\Foundation\Traits\Collections\Collectible;
use App\Http\Resources\Api\Vacation\VacationsResource;

class VacationController extends Controller
{
    use Collectible;

    public function findVacations()
    {
        $vacations = Repository::vacations()->findAllActive();

        if ($vacations->isEmpty()) {
            throw new VacationsNotFound('Не найдено ни одного отпуска');
        }

        $employees = Repository::employees()->findByIds($this->pluckUniqueAttr($vacations, 'employee_id'), false);

        return response()->jsonResponse(
            (new VacationsResource(collect(compact('vacations', 'employees'))))->toArray()
        );
    }
}
