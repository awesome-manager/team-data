<?php

namespace App\Http\Resources\Api\Position;

use Awesome\Foundation\Traits\Resources\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PositionsResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'positions' => $this->resource->map(function ($position) {
                return [
                    'id' => $this->string($position->id),
                    'title' => $this->string($position->title),
                    'code' => $this->string($position->code),
                ];
            })
        ];
    }
}
