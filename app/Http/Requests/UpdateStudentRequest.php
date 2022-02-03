<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateStudentRequest extends FormRequest
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
            'firstname' => 'string',
            'lastname' => 'string',
            'date_of_birth' => 'date|date_format:Y-m-d|before_or_equal:today',
            'date_of_enroll' => 'date|date_format:Y-m-d|before_or_equal:today',
            'credits' => 'integer',
            'group_id' => 'int|exists:App\Models\Subject,id'
        ];
    }
}
