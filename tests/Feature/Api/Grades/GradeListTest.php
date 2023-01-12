<?php

namespace Tests\Feature\Api\Grades;

use App\Models\Grade;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Awesome\Foundation\Traits\Tests\{DataHandler, Queryable};

class GradeListTest extends TestCase
{
    use DataHandler, Queryable, RefreshDatabase;

    private string $route = '/api/v1/grades';

    public function test_find_all_active(): void
    {
        $grades = Grade::createList(10);

        $this->checkAssert(
            $this->get($this->route),
            $this->getListStruture(),
            $grades->where('is_active', true)->count(),
            'content.grades'
        );
    }

    public function test_find_active_by_ids(): void
    {
        $grades = Grade::createList(10);

        $randomGrades = $grades->random(rand(1, 10));

        $this->checkAssert(
            $this->get($this->route . $this->buildIdsQuery($randomGrades->pluck('id')->all())),
            $this->getListStruture(),
            $randomGrades->where('is_active', true)->count(),
            'content.grades'
        );
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
