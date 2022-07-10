<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\TeamData\Contracts\Services\EmployeeService;
use App\Http\Resources\Api\Employee\EmployeeResource;

class EmployeeController extends Controller
{
    //TODO:: Add custom request
    public function findEmployees(EmployeeService $service)
    {
        return (new EmployeeResource($service->findAllActive()))->toArray();
    }
}
