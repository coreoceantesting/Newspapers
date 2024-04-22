<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountDetailRequest extends FormRequest
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
        if ($this->id) {
            return [
                'news_paper_id' => 'required',
                'bank' => 'required',
                'branch' => 'required',
                'account_number' => "required|unique:account_details,account_number,$this->id",
                'ifsc_code' => 'required',
                'pan_card' => 'required',
                'gst_no' => 'nullable',
                'document' => 'nullable'
            ];
        } else {
            return [
                'news_paper_id' => 'required',
                'bank' => 'required',
                'branch' => 'required',
                'account_number' => 'required|unique:account_details',
                'ifsc_code' => 'required',
                'pan_card' => 'required',
                'gst_no' => 'nullable',
                'document' => 'nullable'
            ];
        }
    }

    public function messages()
    {
        return [
            'news_paper_id.required' => 'कृपया वर्तमानपत्र निवडा',
            'bank.required' => 'कृपया बँकेचे नाव प्रविष्ट करा',
            'branch.required' => 'कृपया शाखा प्रविष्ट करा',
            'account_number.required' => 'कृपया खाते क्रमांक प्रविष्ट करा',
            'account_number.unique' => 'खाते क्रमांक मला अद्वितीय असावा',
            'ifsc_code.required' => 'कृपया IFSC कोड प्रविष्ट करा',
            'pan_card.required' => 'कृपया पॅन कार्ड प्रविष्ट करा',
            'gst_no.required' => 'कृपया GST क्रमांक प्रविष्ट करा',
        ];
    }
}
