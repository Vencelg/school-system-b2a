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
            'deadline_date' => 'date|required|after_or_equal:today|date_format:Y-m-d',
            'credits_to_give' =>'int|required',
            'subject_id' => 'int|required|exists:App\Models\Subject,id'
        ];
    }
}
