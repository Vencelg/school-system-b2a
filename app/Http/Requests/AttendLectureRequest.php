<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AttendLectureRequest extends FormRequest
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
            'student_id' => 'int|required|exists:App\Models\Student,id',
            'lecture_id' => 'int|required|exists:App\Models\Lecture,id',
        ];
    }
}
