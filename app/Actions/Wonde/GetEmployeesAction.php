<?php

namespace App\Actions\Wonde;

class GetEmployeesAction extends AbstractWondeAction
{
    public function run()
    {

        //get the employees with a class
        $employees = $this->school->employees->all(['classes'], ['has_class' => true, 'has_role' => true, 'per_page' => 20]);

        return collect($employees->array)->map(function ($employee) {
            return [
                'value' => $employee->id,
                'name' => $employee->title.' '.$employee->forename.' '.$employee->surname,
            ];
        });
    }
}
