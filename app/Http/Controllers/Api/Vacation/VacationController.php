<?php

namespace App\Http\Controllers\Api\Vacation;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Exceptions\VacationsNotFound;
use App\Http\Requests\Api\Vacation\FindRequest;
use App\Models\Employee;
use Awesome\Foundation\Traits\Collections\Collectible;
use App\Http\Resources\Api\Vacation\VacationsResource;

class VacationController extends Controller
{
    use Collectible;

    public function findVacations(FindRequest $request)
    {
        $employees = $request->query('active_only_employees', true)
            ? Repository::employees()->findAllActive()
            : Repository::employees()->findAll();

        $vacations =  Repository::vacations()->findByEmployeeIds($this->pluckUniqueAttr($employees, 'id'));

        if ($vacations->isEmpty()) {
            throw new VacationsNotFound('Не найдено ни одного отпуска');
        }

        $employeeIds = $this->pluckUniqueAttr($vacations, 'employee_id');

        $employees = $employees->filter(
            fn (Employee $employee) => in_array($employee->getAttribute('id'), $employeeIds)
        )->values();

        return response()->jsonResponse(
            (new VacationsResource(collect(compact('vacations', 'employees'))))->toArray()
        );
    }
}
