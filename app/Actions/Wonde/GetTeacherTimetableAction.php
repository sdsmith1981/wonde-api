<?php

namespace App\Actions\Wonde;

use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;

class GetTeacherTimetableAction
{

    public function run(array $data)
    {

        return Cache::remember('timetable_' . Arr::get($data, 'teacher'), now()->addHour(), function () use ($data) {

            $teacher = app()->make(GetTeacherAction::class)->run(Arr::get($data, 'teacher'), ['classes']);

            return collect($teacher->classes->data)->flatMap(function ($class) {
                $result = app()->make(GetClassesAction::class)->run($class->id, ['students', 'lessons', 'subject', 'lessons.room', 'lessons.period']);

                return collect($result->lessons->data)->map(function ($lesson) use ($result) {
                    return array_merge((array)$lesson, [
                        'class' => Arr::only((array)$result, [
                            'name',
                            'description',
                            'subject',
                        ]),
                        'students' => $result->students->data,
                    ]);
                });
            })->sortBy(function ($item) {
                return Carbon::parse(Arr::get($item, 'start_at')->date);
            })->groupBy(function ($item) {
                return Carbon::parse(Arr::get($item, 'start_at')->date)->format('d F Y');
            })->sortBy(function ($value, $key) {
                return $key;
            }, SORT_REGULAR, false);
        });
    }
}
