<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateExerciseRequest extends FormRequest
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
            'own_computer' => 'boolean',
            'credits_to_give' => 'int',
            'subject_id' => 'int|exists:App\Models\Subject,id',
            'teacher_id' => 'int|required|exists:App\Models\Teacher,id'
        ];
    }
}
