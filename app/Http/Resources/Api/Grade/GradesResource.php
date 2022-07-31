<?php

namespace App\Http\Resources\Api\Grade;

use Awesome\Foundation\Traits\Resourceable;
use Illuminate\Http\Resources\Json\ResourceCollection;

class GradesResource extends ResourceCollection
{
    use Resourceable;

    public function toArray($request = null)
    {
        return [
            'grades' => $this->resource->map(function ($grade) {
                return [
                    'id' => $this->string($grade->id),
                    'title' => $this->string($grade->title),
                    'code' => $this->string($grade->code),
                ];
            })
        ];
    }
}
