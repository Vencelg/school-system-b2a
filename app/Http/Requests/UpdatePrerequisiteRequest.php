<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePrerequisiteRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'deadline_date' => 'date|after_or_equal:today|date_format:Y-m-d',
            'student_id' => 'int|exists:App\Models\Student,id',
            'subject_id' => 'int|exists:App\Models\Subject,id',
        ];
    }
}
