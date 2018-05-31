<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class AdminRequest extends FormRequest
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
        $usernameUnique = Rule::unique('admins', 'username');

        return [
            'username' => [
                'required',
                $this->isMethod('post') ? $usernameUnique : $usernameUnique->ignore($this->segment(2)),
            ],
            'name' => 'required',
            'password' => ['sometimes', 'string', 'min:6', 'confirmed'],
        ];
    }
}
