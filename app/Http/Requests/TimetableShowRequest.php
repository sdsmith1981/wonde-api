<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TimetableShowRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'teacher' => 'required',
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
