<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BillingRequest extends FormRequest
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
            'department_id' => 'required',
            'advertise_id' => 'required',
            'news_paper_id' => 'required',
            'bill_number' => 'required',
            'bill_date' => 'required',
            'basic_amount' => 'required',
            'gst' => 'required',
            'gross_amount' => 'required',
            'tds' => 'required',
            'it' => 'required',
            'net_amount' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'department_id.required' => 'कृपया विभाग निवडा',
            'advertise_id.required' => 'कृपया जाहिरात निवडा',
            'news_paper_id.required' => 'कृपया वर्तमानपत्र निवडा',
            'bill_number.required' => 'कृपया बिल क्रमांक प्रविष्ट करा',
            'bill_date.required' => 'कृपया बिल तारीख निवडा',
            'basic_amount.required' => 'कृपया मूळ रक्कम प्रविष्ट करा',
            'gst.required' => 'कृपया GST प्रविष्ट करा',
            'gross_amount.required' => 'कृपया एकूण रक्कम प्रविष्ट करा',
            'tds.required' => 'कृपया TDS प्रविष्ट करा',
            'it.required' => 'कृपया IT प्रविष्ट करा',
            'net_amount.required' => 'कृपया निव्वळ रक्कम प्रविष्ट करा',
        ];
    }
}
