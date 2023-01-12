<?php

namespace Tests\Feature\Api\Positions;

use App\Models\Position;
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PositionListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/positions';

    public function test_find_all_active(): void
    {
        $positions = Position::createList(10);

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStructure(),
            $positions->where('is_active', true)->count(),
            'content.positions'
        );
    }

    public function test_find_active_by_ids(): void
    {
        $positions = Position::createList(10);

        $randomPositions = $positions->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($randomPositions->pluck('id')->all())),
            $this->getListStructure(),
            $randomPositions->where('is_active', true)->count(),
            'content.positions'
        );
    }

    private function getListStructure(): array
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
