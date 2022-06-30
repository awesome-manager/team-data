<?php

namespace App\Http\Controllers\Api\Grade;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Grade\Grades;

class GradeController extends Controller
{
    public function findGrades()
    {
        return (new Grades(Repository::grades()->findAllActive()))->toArray();
    }
}
