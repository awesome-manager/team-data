<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\PositionFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'code',
        'title',
        'is_active',
    ];

    protected static function newFactory(): Factory
    {
        return PositionFactory::new();
    }
}
