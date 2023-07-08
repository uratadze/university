<?php

namespace App\Http\Requests\Teacher;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
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
            'first_name' => 'required|string|max:50',
            'last_name' => 'required|string|max:50',
            'personal_id' => 'required',
            'emails' => 'required|array',
            'date_of_birth' => 'required',
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
