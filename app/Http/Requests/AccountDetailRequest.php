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
        if ($this->id){
            return [
                'news_paper_id' => 'required',
                'bank' => 'required',
                'branch' => 'required',
                'account_number' => "required|unique:account_details,account_number,$this->id",
                'ifsc_code' => 'required',
                'pan_card' => 'required',
                'gst_no' => 'nullable'
            ];
        }else{
            return [
                'news_paper_id' => 'required',
                'bank' => 'required',
                'branch' => 'required',
                'account_number' => 'required|unique:account_details',
                'ifsc_code' => 'required',
                'pan_card' => 'required',
                'gst_no' => 'nullable'
            ];
        }
    }

    public function messages()
    {
        return [

        ];
    }
}
