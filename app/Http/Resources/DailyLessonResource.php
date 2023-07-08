<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class DailyLessonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return ClassRegisterResource::collection($this->resource)->toArray($request);
    }
}
