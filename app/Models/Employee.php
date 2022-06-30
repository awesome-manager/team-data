<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Awesome\Foundation\Traits\AwesomeModel;

class Employee extends Model
{
    use AwesomeModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'surname',
        'grade_id',
        'probation',
        'is_active',
        'position_id',
        'employment_at',
    ];

    public function grade()
    {
        return $this->hasOne(Grade::class, 'id', 'grade_id');
    }

    public function position()
    {
        return $this->hasOne(Position::class, 'id', 'position_id');
    }
}
