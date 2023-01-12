<?php

namespace Tests\Feature\Api\Vacations;

use App\Models\{Employee, Grade, Position, Vacation};
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Collection;
use Tests\TestCase;

class VacationListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/vacations';

    public function test_find_all_with_active_employees(): void
    {
        $vacations = $this->createVacations();

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStructure(),
            $vacations->where('employee.is_active', true)->count(),
            'content.vacations'
        );
    }

    public function test_find_all(): void
    {
        $vacations = $this->createVacations();

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery(['active_only_employees' => 0])),
            $this->getListStructure(),
            $vacations->count(),
            'content.vacations'
        );
    }

    private function createVacations(int $count = 10): Collection
    {
        $grades = Grade::createActiveList(10);
        $positions = Position::createActiveList(10);

        $employees = Employee::createCustomList($this->createCustomData(10, [
            'grade_id' => $grades,
            'position_id' => $positions
        ]));

        return Vacation::createCustomList($this->createCustomData($count, [
            'employee_id' => $employees
        ]));
    }

    private function getListStructure(): array
    {
        return [
            'error',
            'content' => [
                'vacations' => [
                    '*' => [
                        'id',
                        'started_at',
                        'ended_at',
                        'employee_id'
                    ]
                ],
                'employees' => [
                    '*' => [
                        'id',
                        'name',
                        'surname'
                    ]
                ]
            ]
        ];
    }
}
