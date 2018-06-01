<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ScheduleRequest extends FormRequest
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
        return [
            'from' => ['required', 'different:to', Rule::exists('outlets', 'id')],
            'to' => ['required', 'different:from', Rule::exists('outlets', 'id')],
            'date' => ['required', 'date'],
            'time' => ['required', 'string'],
            'price' => ['required', 'numeric'],
        ];
    }
}
