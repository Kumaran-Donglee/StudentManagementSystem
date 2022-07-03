<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'student_name' => 'required',
            'age' => 'required',
            'gender_id' => 'required',
            'teacher_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'teacher_id.required' => 'Please Select the reporting teacher. If teacher value is not there please add it and try.'
        ];
    }
}
