<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentMarkRequest extends FormRequest
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
            'student_id' => 'required',
            'term_id' => 'required',
            'maths' => 'required',
            'science' => 'required',
            'history' => 'required',
            // 'total_marks' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'student_id.required' => 'Please Select the Student Name. If Student Name is not there please add it and try.',
            'term_id.required' => 'Please Select the term. If term value is not there please add it and try.'
        ];
    }
}
