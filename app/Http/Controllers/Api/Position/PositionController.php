<?php

namespace App\Http\Controllers\Api\Position;

use App\Facades\Repository;
use App\Http\Controllers\Controller;
use App\Http\Resources\Api\Position\Positions;

class PositionController extends Controller
{
    public function findPositions()
    {
        return (new Positions(Repository::positions()->findAllActive()))->toArray();
    }
}
