<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\VacationFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Vacation extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'ended_at',
        'started_at',
        'employee_id',
    ];

    protected $casts = [
        'started_at',
        'ended_at',
    ];

    protected static function newFactory(): Factory
    {
        return VacationFactory::new();
    }

    public function employee(): HasOne
    {
        return $this->hasOne(Employee::class, 'id', 'employee_id');
    }
}
