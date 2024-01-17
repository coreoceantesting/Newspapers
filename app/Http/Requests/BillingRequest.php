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
            'bank' => 'required',
            'branch' => 'required',
            'account_number' => 'required',
            'ifsc_code' => 'required',
            'pan_card' => 'required',
            'isn' => 'required',
            'basic_amount' => 'required',
            'gst' => 'required',
            'gross_amount' => 'required',
            'tds' => 'required',
            'it' => 'required',
            'net_amount' => 'required',
        ];
    }
}
