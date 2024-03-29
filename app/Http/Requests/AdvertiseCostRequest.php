<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvertiseCostRequest extends FormRequest
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
            'news_paper_type_id' => 'required',
            'language_id' => 'required',
            'no_of_newspaper' => 'required|numeric',
            'cost_id' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'news_paper_id.required' => 'कृपया वर्तमानपत्र निवडा',
            'language_id.required' => 'कृपया भाषा निवडा',
            'no_of_newspaper.required' => 'कृपया वर्तमानपत्र क्रमांक प्रविष्ट करा',
            'no_of_newspaper.numeric' => 'कृपया अंकीय मूल्य प्रविष्ट करा',
            'cost_id.required' => 'कृपया किंमत निवडा',
        ];
    }
}
