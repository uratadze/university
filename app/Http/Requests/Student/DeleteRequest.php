<?php

namespace App\Http\Requests\Student;

use Illuminate\Foundation\Http\FormRequest;

class DeleteRequest extends FormRequest
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
            'student_id' => 'required|exists:university_collectives,id,type_id,1',
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'student_id.exists' => 'Person not found!'
        ];
    }
}
