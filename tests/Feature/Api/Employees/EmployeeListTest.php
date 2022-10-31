<?php

namespace Tests\Feature\Api\Employees;

use App\Models\{Employee, Grade, Position};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EmployeeListTest extends TestCase
{
    use RefreshDatabase;

    private string $route = '/api/v1/employees';

    public function test_find_all(): void
    {
        $grades = Grade::factory()->count(10)->create(['is_active' => true]);
        $positions = Position::factory()->count(10)->create(['is_active' => true]);
        $employees = collect();

        for ($i = 0; $i < 10; $i++) {
            $employees->push(Employee::factory()->create([
                'grade_id' => $grades->random()->id,
                'position_id' => $positions->random()->id
            ]));
        }

        $response = $this->get($this->route);

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($employees->where('is_active', true)->count(), 'content.employees');
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
