<?php

namespace App\Http\Resources\Api\Position;

use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Http\Resources\Json\JsonResource;

class PositionsResource extends JsonResource
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