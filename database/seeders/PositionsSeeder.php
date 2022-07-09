<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Seeder;

class PositionsSeeder extends Seeder
{
    private array $data = [
        [
            'title' => 'Менеджер',
            'code' => 'manager'
        ],
        [
            'title' => 'Программист',
            'code' => 'developer'
        ],
        [
            'title' => 'Тимлид',
            'code' => 'teamlead'
        ],
        [
            'title' => 'Тестировщик',
            'code' => 'qa'
        ],
        [
            'title' => 'Аналитик',
            'code' => 'analyst'
        ],
        [
            'title' => 'Дизайнер',
            'code' => 'design'
        ],
        [
            'title' => 'Верстальщик',
            'code' => 'front'
        ],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->data as $el) {
            Position::query()->create($el);
        }
    }
}
