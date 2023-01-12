<?php

namespace App\Http\Resources\Api\Employee;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeesResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null): array
    {
        return [
            'employees' => $this->resource->map(function ($employee) {
                return [
                    'id' => $this->string($employee->id),
                    'name' => $this->string($employee->name),
                    'surname' => $this->string($employee->surname),
                    'employment_at' => $this->timestamp($employee->employment_at),
                    'probation' => $this->timestamp($employee->probation),
                    'grade_id' => $this->string($employee->grade_id),
                    'position_id' => $this->string($employee->position_id),
                ];
            })
        ];
    }
}
