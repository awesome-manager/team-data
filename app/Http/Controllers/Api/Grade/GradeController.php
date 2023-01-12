<?php

namespace App\Http\Controllers\Api\Grade;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Grade\FindRequest;
use App\Http\Resources\Api\Grade\GradesResource;

class GradeController extends Controller
{
    public function findGrades(FindRequest $request)
    {
        return response()->jsonResponse((new GradesResource(
            empty($request->query('ids', []))
                ? Repository::grades()->findAllActive()
                : Repository::grades()->findById($request->query('ids'))
        ))->toArray());
    }
}
