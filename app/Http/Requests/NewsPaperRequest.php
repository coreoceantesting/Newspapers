<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPaperRequest extends FormRequest
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
            'name' => 'required',
            'editor_name' => 'required',
            'email.*' => 'required|regex:/(.+)@(.+)\.(.+)/i',
            'mobile.*' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'news_paper_type_id.required' => 'कृपया प्रसिध्दीचा स्तर निवडा',
            'language_id.required' => 'कृपया भाषा निवडा',
            'name.required' => 'कृपया नाव प्रविष्ट करा',
            'editor_name.required' => 'कृपया संपादकाचे नाव प्रविष्ट करा',
            'email.*.required' => 'कृपया ईमेल प्रविष्ट करा',
            'mobile.*.required' => 'कृपया मोबाईल नंबर टाका',
            'email.*.regex' => 'कृपया वैध ईमेल प्रविष्ट करा',
            'mobile.*.numeric' => 'कृपया फक्त नंबर फील्ड प्रविष्ट करा'
        ];
    }
}
