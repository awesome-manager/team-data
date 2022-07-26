<?php

namespace App\Http\Resources\Api\Vacation;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Resources\Json\JsonResource;

class VacationsResource extends JsonResource
{
    use Resourceable;

    private Collection $vacations;
    private Collection $positions;

    public function __construct($resource)
    {
        $this->vacations = $resource->get('vacations');
        $this->positions = $resource->get('positions')->keyBy('id');

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
                    'employee' => $this->prepareEmployee($vacation->employee)
                ];
            })
        ];
    }

    private function prepareEmployee(?Model $employee): array
    {
        if (is_null($employee)){
            return [];
        }

        return [
            'id' => $this->string($employee->id),
            'name' => $this->string($employee->name),
            'surname' => $this->string($employee->surname),
            'position' => $this->preparePosition($employee->position_id)
        ];
    }

    private function preparePosition(string $id): array
    {
        if (is_null($position = $this->positions->get($id))) {
            return [];
        }

        return [
            'id' => $this->string($position->id),
            'title' => $this->string($position->title),
            'code' => $this->string($position->code),
        ];
    }
}
