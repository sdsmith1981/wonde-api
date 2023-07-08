<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Arr;

class ClassRegisterResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'start_time' => Carbon::parse(Arr::get($this->resource, 'start_at')?->date)->format('H:i'),
            'end_time' => Carbon::parse(Arr::get($this->resource, 'end_at')?->date)->format('H:i'),
            'name' => Arr::get($this->resource, 'class.name'),
            'description' => Arr::get($this->resource, 'class.description'),
            'subject' => Arr::get($this->resource, 'class.subject')?->data?->name,
            'students' => StudentResource::collection(Arr::get($this->resource, 'students')),
            'room' => [
                'code' => Arr::get($this->resource, 'room')?->data?->code,
                'name' => Arr::get($this->resource, 'room')?->data?->name,
            ],
        ];
    }
}
