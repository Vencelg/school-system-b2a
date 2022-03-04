<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddLectureToGroupRequest extends FormRequest
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
            'group_id' => 'int|required|exists:App\Models\Group,id',
            'lecture_id' => 'int|required|exists:App\Models\Lecture,id',
            'presentation_date' => 'date|required|after_or_equal:today|date_format:Y-m-d'
        ];
    }
}
