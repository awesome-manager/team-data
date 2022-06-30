<?php

namespace App\Http\Resources\Api\Grade;

use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Http\Resources\Json\JsonResource;

class Grades extends JsonResource
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'grades' => $this->resource->map(function ($grade) {
                return [
                    'title' => $this->string($grade->title),
                    'code' => $this->string($grade->code),
                ];
            })
        ];
    }
}
