<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            'teacher_id' => 'required|exists:university_collectives,id,type_id,2',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'teacher_id.exists' => 'Teacher not found!'
        ];
    }
}
