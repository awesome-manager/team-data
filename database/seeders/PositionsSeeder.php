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
