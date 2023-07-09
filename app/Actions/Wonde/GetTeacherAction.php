<?php

namespace App\Actions\Wonde;

use Illuminate\Support\Facades\Cache;

class GetTeacherAction extends AbstractWondeAction
{
    public function run($teacherId, array $includes)
    {
        return Cache::remember('teacher_'.$teacherId, now()->addHour(), function () use ($teacherId, $includes) {
            return $this->school->employees->get($teacherId, $includes);
        });
    }
}
