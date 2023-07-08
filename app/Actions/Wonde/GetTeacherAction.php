<?php

namespace App\Actions\Wonde;

class GetTeacherAction extends AbstractWondeAction
{
    public function run($teacherId, array $includes)
    {
        return $this->school->employees->get($teacherId, $includes);
    }
}
