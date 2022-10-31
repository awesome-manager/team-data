<?php

namespace Database\Factories;

use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;

class PositionFactory extends Factory
{
    protected $model = Position::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->word(),
            'code' => $this->faker->unique()->word(),
            'sort' => $this->faker->randomNumber(4),
            'is_active' => $this->faker->boolean()
        ];
    }
}
