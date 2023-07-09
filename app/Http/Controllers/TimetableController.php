<?php

namespace App\Http\Controllers;

use App\Actions\Wonde\GetEmployeesAction;
use App\Actions\Wonde\GetTeacherTimetableAction;
use App\Http\Requests\TimetableShowRequest;
use App\Http\Resources\DailyLessonResource;
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
        $timetable = app()->make(GetTeacherTimetableAction::class)->run($request->validated());

        return DailyLessonResource::collection($timetable);

    }
}
