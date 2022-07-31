<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\TeamData\Contracts\Services\EmployeeService;
use App\Http\Resources\Api\Employee\EmployeesResource;

class EmployeeController extends Controller
{
    public function findEmployees(EmployeeService $service)
    {
        return response()->jsonResponse((new EmployeesResource($service->findAllActive()))->toArray());
    }
}
