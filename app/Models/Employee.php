<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\EmployeeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Employee extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'name',
        'surname',
        'grade_id',
        'probation',
        'is_active',
        'position_id',
        'employment_at',
    ];

    protected $casts = [
        'employment_at',
        'probation',
    ];

    protected static function newFactory(): Factory
    {
        return EmployeeFactory::new();
    }

    public function grade(): HasOne
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }

    public function position(): HasOne
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
