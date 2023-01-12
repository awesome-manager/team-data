<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\FindRequest;
use App\Http\Resources\Api\Employee\EmployeesResource;
use App\TeamData\Contracts\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function findEmployees(FindRequest $request, EmployeeService $service)
    {
        return response()->jsonResponse(
            (new EmployeesResource(
                $service->find(
                    $request->query('ids', []),
                    $request->query('active_only', false)
                )
            ))->toArray()
        );
    }
}
