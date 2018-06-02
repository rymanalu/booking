<?php
/**
 * Created by PhpStorm.
 * User: manalu
 * Date: 02/06/18
 * Time: 09.58
 */

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OutletRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => ['required', 'string'],
            'address' => ['required', 'string'],

        ];
    }

}