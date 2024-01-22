<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DepartmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'initial' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'कृपया नाव प्रविष्ट करा',
            'initial.required' => 'कृपया प्रारंभिक प्रविष्ट करा',
        ];
    }
}
