<?php

namespace App\Http\Requests\Group;

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
            'group_id' => 'required|exists:groups,id',
            'name' => 'required_without:group_address_id|string',
            'group_address_id' => 'required_without:name|string'
        ];
    }

    /**
     * @return string[]
     */
    public function messages(): array
    {
        return [
            'group_id.exists' => 'Group not found!'
        ];
    }
}
