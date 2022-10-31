<?php

namespace Tests\Feature\Api\Employees;

use App\Models\{Employee, Grade, Position};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Awesome\Foundation\Traits\Tests\DataHandler;

class EmployeeListTest extends TestCase
{
    use DataHandler, RefreshDatabase;

    private string $route = '/api/v1/employees';

    public function test_find_all(): void
    {
        $grades = Grade::createActiveList(10);
        $positions = Position::createActiveList(10);

        $employees = Employee::createCustomList($this->createCustomData(10, [
            'grade_id' => $grades,
            'position_id' => $positions
        ]));

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $employees->where('is_active', true)->count(),
            'content.employees'
        );
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
                        'grade' => [
                            'id',
                            'title',
                            'code'
                        ],
                        'position' => [
                            'id',
                            'title',
                            'code'
                        ],
                    ]
                ]
            ]
        ];
    }
}
