<?php

namespace App\Http\Controllers\Api\Grade;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Grade\GradesResource;

class GradeController extends Controller
{
    public function findGrades()
    {
        return (new GradesResource(Repository::grades()->findAllActive()))->toArray();
    }
}
