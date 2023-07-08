<?php

namespace App\Http\Controllers;

use App\Actions\Wonde\GetClassesAction;
use App\Actions\Wonde\GetEmployeesAction;
use App\Actions\Wonde\GetTeacherAction;
use App\Http\Requests\TimetableShowRequest;
use App\Http\Resources\DailyLessonResource;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Inertia\Inertia;

class TimetableController extends Controller
{
    public function index()
    {
        $employees = app()->make(GetEmployeesAction::class)->run();

        return Inertia::render('Dashboard',
            [
                'employees' => $employees,
            ]);
    }

    public function show(TimetableShowRequest $request)
    {
        $data = $request->validated();
        $teacher = app()->make(GetTeacherAction::class)->run(Arr::get($data, 'teacher'), ['classes']);

        $data = collect($teacher->classes->data)->flatMap(function ($class) {
            $result = app()->make(GetClassesAction::class)->run($class->id, ['students', 'lessons', 'subject', 'lessons.room', 'lessons.period']);

            return collect($result->lessons->data)->map(function ($lesson) use ($result) {
                return array_merge((array) $lesson, [
                    'class' => Arr::only((array) $result, [
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

        return DailyLessonResource::collection($data);

    }
}
