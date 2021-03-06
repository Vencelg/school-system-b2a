<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreExerciseRequest extends FormRequest
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
            'name' => 'string|required',
            'own_computer' => 'boolean|required',
            'credits_to_give' =>'int|required',
            'subject_id' => 'int|required|exists:App\Models\Subject,id',
            'teacher_id' => 'int|required|exists:App\Models\Teacher,id'
        ];
    }
}
