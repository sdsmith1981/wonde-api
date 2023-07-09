<?php

namespace App\Actions\Wonde;

use Illuminate\Support\Facades\Cache;

class GetClassesAction extends AbstractWondeAction
{
    public function run($classId, array $includes)
    {
        return Cache::remember('class_' . $classId, now()->addHour(), function () use ($classId, $includes) {
            return $this->school->classes->get($classId, $includes);
        });
    }
}
