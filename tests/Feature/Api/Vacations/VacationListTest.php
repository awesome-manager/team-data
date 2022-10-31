<?php

namespace Tests\Feature\Api\Vacations;

use App\Models\{Employee, Grade, Position, Vacation};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class VacationListTest extends TestCase
{
    use RefreshDatabase;

    private string $route = '/api/v1/vacations';

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

        $vacations = collect();
        for ($i = 0; $i < 10; $i++) {
            $vacations->push(Vacation::factory()->create([
                'employee_id' => $employees->random()->id
            ]));
        }

        $response = $this->get($this->route);

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($vacations->count(), 'content.vacations');
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
