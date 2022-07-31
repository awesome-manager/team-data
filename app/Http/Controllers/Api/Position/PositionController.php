<?php

namespace App\Http\Controllers\Api\Position;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Position\PositionsResource;

class PositionController extends Controller
{
    public function findPositions()
    {
        return response()->jsonResponse((new PositionsResource(Repository::positions()->findAllActive()))->toArray());
    }
}
