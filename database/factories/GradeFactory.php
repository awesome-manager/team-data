<?php

namespace Database\Factories;

use App\Models\Grade;
use Illuminate\Database\Eloquent\Factories\Factory;

class GradeFactory extends Factory
{
    protected $model = Grade::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'code' => $this->faker->word(),
            'sort' => $this->faker->randomNumber(),
            'is_active' => $this->faker->boolean()
        ];
    }
}
