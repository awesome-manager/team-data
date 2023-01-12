<?php

namespace App\Http\Controllers\Api\Position;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Position\FindRequest;
use App\Http\Resources\Api\Position\PositionsResource;

class PositionController extends Controller
{
    public function findPositions(FindRequest $request)
    {
        return response()->jsonResponse((new PositionsResource(
            empty($request->query('ids', []))
                ? Repository::positions()->findAllActive()
                : Repository::positions()->findByIds($request->query('ids'))
        ))->toArray());
    }
}
