<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $user = user();

        $isUser = isset($user->email);

        $rules = [
            'name' => 'required',
        ];

        if ($this->filled('password')) {
            $rules['password'] = ['required', 'min:6', 'confirmed'];
        }

        if ($isUser) {
            $rules['email'] = ['required', 'email', Rule::unique('users', 'email')->ignore($user->id)];
            $rules['phone_number'] = 'required';
            $rules['address'] = 'required';
        } else {
            $rules['username'] = ['required', Rule::unique('admins', 'username')->ignore($user->id)];
        }

        return $rules;
    }
}
