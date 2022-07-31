<?php

namespace App\Http\Resources\Api\Employee;

use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class EmployeesResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'employees' => $this->resource->map(function ($employee) {
                return [
                    'id' => $this->string($employee->id),
                    'name' => $this->string($employee->name),
                    'surname' => $this->string($employee->surname),
                    'employment_at' => $this->string($employee->employment_at), //TODO:: date Resourceable trait
                    'probation' => $this->string($employee->probation),
                    'grade' => $this->prepareGrade($employee->grade),
                    'position' => $this->preparePosition($employee->position),
                ];
            })
        ];
    }

    private function prepareGrade($grade)
    {
        return [
            'id' => $this->string($grade->id),
            'title' => $this->string($grade->title),
            'code' => $this->string($grade->code),
        ];
    }

    private function preparePosition($position)
    {
        return [
            'id' => $this->string($position->id),
            'title' => $this->string($position->title),
            'code' => $this->string($position->code),
        ];
    }
}
