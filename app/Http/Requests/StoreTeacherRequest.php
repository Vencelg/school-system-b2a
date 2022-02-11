<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeacherRequest extends FormRequest
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
            'title' => 'string|required',
            'firstname' => 'string|required',
            'lastname' => 'string|required',
            'date_of_birth' => 'date|required|before:today|date_format:Y-m-d',
            'subject_id' => 'int|required|exists:App\Models\Subject,id'
        ];
    }
}
