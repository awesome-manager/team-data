<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Employee\EmployeesResource;
use App\TeamData\Contracts\Services\EmployeeService;

class EmployeeController extends Controller
{
    public function findEmployees(EmployeeService $service)
    {
        return response()->jsonResponse((new EmployeesResource($service->findAllActive()))->toArray());
    }
}
