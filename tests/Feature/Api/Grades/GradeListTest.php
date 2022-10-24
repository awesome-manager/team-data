<?php

namespace Tests\Feature\Api\Grades;

use App\Models\{Employee, Grade, Position};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GradeListTest extends TestCase
{
    use RefreshDatabase;

    private string $route = '/api/v1/grades';

    public function test_find_all(): void
    {
        $grades = Grade::factory()->count(10)->create();

        $response = $this->get($this->route);

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($grades->where('is_active', true)->count(), 'content.grades');
    }

    private function getListStruture(): array
    {
        return [
            'error',
            'content' => [
                'grades' => [
                    '*' => [
                        'id',
                        'title',
                        'code'
                    ]
                ]
            ]
        ];
    }
}
