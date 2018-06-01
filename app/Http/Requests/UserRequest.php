<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
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
        $emailUnique = Rule::unique('users', 'email')->where(function ($query) {
            return $query->whereNull('deleted_at');
        });

        return [
            'email' => [
                'required',
                'email',
                $this->isMethod('post') ? $emailUnique : $emailUnique->ignore($this->segment(2)),
            ],
            'name' => 'required',
            'phone_number' => 'required',
            'address' => 'required',
            'password' => ['sometimes', 'min:6', 'confirmed'],
        ];
    }
}
