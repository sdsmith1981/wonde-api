<?php

namespace App\Actions\Wonde;

class GetClassesAction extends AbstractWondeAction
{
    public function run($classId, array $includes)
    {
        return $this->school->classes->get($classId, $includes);
    }
}
