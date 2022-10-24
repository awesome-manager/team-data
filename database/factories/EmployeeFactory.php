<?php

namespace Database\Factories;

use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EmployeeFactory extends Factory
{
    protected $model = Employee::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'position_id' => Str::uuid()->toString(),
            'grade_id' => Str::uuid()->toString(),
            'employment_at' => $this->faker->date,
            'probation' => $this->faker->date,
            'is_active' => $this->faker->boolean()
        ];
    }
}
