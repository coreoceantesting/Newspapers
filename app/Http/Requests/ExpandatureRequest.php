<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpandatureRequest extends FormRequest
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
            'billing_id' => 'required',
            'news_paper_id' => 'required',
            'invoice_amount' => 'required',
            'other_charges' => 'required',
            'net_amount' => 'required',
            'progressive_expandetures' => 'required',
            'balance' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'billing_id.required' => 'कृपया बिल निवडा',
            'news_paper_id.required' => 'कृपया वर्तमानपत्र निवडा',
            'invoice_amount.required' => 'कृपया invoice number प्रविष्ट करा',
            'other_charges.required' => 'कृपया other charges प्रविष्ट करा',
            'net_amount.required' => 'कृपया net amount प्रविष्ट करा',
            'progressive_expandetures.required' => 'कृपया progressive expandetures प्रविष्ट करा',
            'balance.required' => 'कृपया balance amount प्रविष्ट करा',
        ];
    }
}
