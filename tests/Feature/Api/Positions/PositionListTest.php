<?php

namespace Tests\Feature\Api\Positions;

use App\Models\Position;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Awesome\Foundation\Traits\Tests\DataHandler;

class PositionListTest extends TestCase
{
    use DataHandler, RefreshDatabase;

    private string $route = '/api/v1/positions';

    public function test_find_all(): void
    {
        $positions = Position::createList(10);

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $positions->where('is_active', true)->count(),
            'content.positions'
        );
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
