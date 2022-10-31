<?php

namespace Tests\Feature\Api\Vacations;

use App\Models\{Employee, Grade, Position, Vacation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Awesome\Foundation\Traits\Tests\DataHandler;

class VacationListTest extends TestCase
{
    use DataHandler, RefreshDatabase;

    private string $route = '/api/v1/vacations';

    public function test_find_all(): void
    {
        $grades = Grade::createActiveList(10);
        $positions = Position::createActiveList(10);

        $employees = Employee::createCustomList($this->createCustomData(10, [
            'grade_id' => $grades,
            'position_id' => $positions
        ]));

        $vacations = Vacation::createCustomList($this->createCustomData(10, [
            'employee_id' => $employees
        ]));

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $vacations->count(),
            'content.vacations'
        );
    }

    private function getListStruture(): array
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
