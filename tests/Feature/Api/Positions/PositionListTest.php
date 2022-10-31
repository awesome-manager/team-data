<?php

namespace Tests\Feature\Api\Positions;

use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PositionListTest extends TestCase
{
    use RefreshDatabase;

    private string $route = '/api/v1/positions';

    public function test_find_all(): void
    {
        $grades = Position::factory()->count(10)->create();

        $response = $this->get($this->route);

        $response->assertOk()
            ->assertJsonStructure($this->getListStruture())
            ->assertJsonCount($grades->where('is_active', true)->count(), 'content.positions');
    }

    private function getListStruture(): array
    {
        return [
            'error',
            'content' => [
                'positions' => [
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
