<?php

namespace App\Http\Resources\Api\Vacation;

use Illuminate\Database\Eloquent\Collection;
use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class VacationsResource extends ResourceCollection
{
    use Resourceable;

    private Collection $vacations;
    private Collection $employees;

    public function __construct($resource)
    {
        $this->vacations = $resource->get('vacations');
        $this->employees = $resource->get('employees');

        parent::__construct($resource);
    }

    public function toArray($request = null)
    {
        return [
            'vacations' => $this->vacations->map(function ($vacation) {
                return [
                    'id' => $this->string($vacation->id),
                    'started_at' => $this->string($vacation->started_at), //TODO:: add timestamp resource
                    'ended_at' => $this->string($vacation->ended_at),
                    'employee_id' => $this->string($vacation->employee_id)
                ];
            }),
            'employees' => $this->employees->map(function ($employee) {
                return [
                    'id' => $this->string($employee->id),
                    'name' => $this->string($employee->name),
                    'surname' => $this->string($employee->surname)
                ];
            })
        ];
    }
}
