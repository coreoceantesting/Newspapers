<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FinancialYearRequest extends FormRequest
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
            'year' => 'required',
            'from_date' => 'required',
            'to_date' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'year.required' => 'कृपया वर्ष प्रविष्ट करा',
            'from_date.required' => 'कृपया तारखेपासून निवडा',
            'to_date.required' => 'कृपया आजपर्यंत निवडा',
        ];
    }
}
