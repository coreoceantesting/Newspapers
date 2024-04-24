<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
                'name' => 'required',
                'email' => 'required',
                'user_type' => 'required',
                'status' => 'required'
            ];
        } else {
            return [
                'name' => 'required',
                'email' => 'required',
                'password' => 'required',
                'user_type' => 'required',
                'status' => 'required'
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'Please enter name',
            'email.required' => 'Please enter email',
            'password.required' => 'Please enter password',
            'user_type.required' => 'Please select user type',
            'status.required' => 'Please select status',
        ];
    }
}
