<?php

namespace App\Models;

use Awesome\Foundation\Traits\Models\AwesomeModel;
use Database\Factories\GradeFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model
{
    use AwesomeModel;

    protected $fillable = [
        'code',
        'title',
        'is_active',
    ];

    protected static function newFactory(): Factory
    {
        return GradeFactory::new();
    }
}
