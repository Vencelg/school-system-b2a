<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStudentRequest extends FormRequest
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
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'date_of_birth' => 'date|required|date_format:Y-m-d',
            'date_of_enroll' => 'date|required|date_format:Y-m-d',
            'group_id' => 'int|required'
        ];
    }
}
