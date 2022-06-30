<?php

namespace Database\Seeders;

use App\Models\Grade;
use Illuminate\Database\Seeder;

class GradesSeeder extends Seeder
{
    private array $data = [
        [
            'title' => 'Junior',
            'code' => 'jun',
        ],
        [
            'title' => 'Junior+',
            'code' => 'jun+',
        ],
        [
            'title' => 'Middle',
            'code' => 'mid',
        ],
        [
            'title' => 'Middle+',
            'code' => 'mid+',
        ],
        [
            'title' => 'Senior',
            'code' => 'sen',
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
            Grade::query()->create($el);
        }
    }
}
