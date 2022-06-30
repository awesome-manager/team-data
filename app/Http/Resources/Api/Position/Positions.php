<?php

namespace App\Http\Resources\Api\Position;

use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Http\Resources\Json\JsonResource;

class Positions extends JsonResource
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'positions' => $this->resource->map(function ($position) {
                return [
                    'title' => $this->string($position->title),
                    'code' => $this->string($position->code),
                ];
            })
        ];
    }
}
