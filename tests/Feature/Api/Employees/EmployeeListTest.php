<?php

namespace Tests\Feature\Api\Employees;

use App\Models\{Employee, Grade, Position};
use Illuminate\Support\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};

class EmployeeListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/employees';

    public function test_find_all(): void
    {
        $employees = $this->createEmployees();

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery(['active_only' => 0])),
            $this->getListStruture(),
            $employees->count(),
            'content.employees'
        );
    }

    public function test_find_all_active(): void
    {
        $employees = $this->createEmployees();

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $employees->where('is_active', true)->count(),
            'content.employees'
        );
    }

    public function test_find_by_ids(): void
    {
        $employees = $this->createEmployees();

        $randomEmployees = $employees->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildQuery([
                'ids' => $randomEmployees->pluck('id')->all(),
                'active_only' => 0
                ])
            ),
            $this->getListStruture(),
            $randomEmployees->count(),
            'content.employees'
        );
    }

    public function test_find_active_by_ids(): void
    {
        $employees = $this->createEmployees();

        $randomEmployees = $employees->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($randomEmployees->pluck('id')->all())),
            $this->getListStruture(),
            $randomEmployees->where('is_active', true)->count(),
            'content.employees'
        );
    }

    private function createEmployees(int $count = 10): Collection
    {
        $grades = Grade::createActiveList($count);
        $positions = Position::createActiveList($count);

        return Employee::createCustomList($this->createCustomData(10, [
            'grade_id' => $grades,
            'position_id' => $positions
        ]));
    }

    private function getListStruture(): array
    {
        return [
            'error',
            'content' => [
                'employees' => [
                    '*' => [
                        'id',
                        'name',
                        'surname',
                        'employment_at',
                        'probation',
                        'grade_id',
                        'position_id',
                    ]
                ]
            ]
        ];
    }
}
