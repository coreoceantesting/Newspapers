<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BudgetProvisionRequest extends FormRequest
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
            'financial_year_id' => 'required',
            'department_id' => 'required',
            'budget' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'financial_year_id.required' => 'कृपया आर्थिक वर्ष निवडा',
            'department_id.required' => 'कृपया विभाग निवडा',
            'budget.required' => 'कृपया बजेट प्रविष्ट करा',
        ];
    }
}
