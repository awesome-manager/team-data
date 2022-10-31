<?php

namespace Database\Factories;

use App\Models\Vacation;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class VacationFactory extends Factory
{
    protected $model = Vacation::class;

    public function definition(): array
    {
        return [
            'employee_id' => Str::uuid()->toString(),
            'started_at' => $this->faker->date(),
            'ended_at' => $this->faker->date()
        ];
    }
}
