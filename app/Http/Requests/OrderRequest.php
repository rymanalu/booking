<?php

namespace App\Http\Requests;

use App\Schedule;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
        $maxQty = 0;

        if ($this->filled('schedule_id')) {
            $schedule = Schedule::find($this->input('schedule_id'));

            if ($schedule) {
                $maxQty = $schedule->available;
            }
        }

        return [
            'schedule_id' => [
                'required',
                Rule::exists('schedules', 'id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'price' => ['required', 'numeric'],
            'user_id' => [
                'required',
                Rule::exists('users', 'id')->where(function ($query) {
                    return $query->whereNull('deleted_at');
                }),
            ],
            'qty' => ['required', 'numeric', "max:{$maxQty}"],
            'total' => ['required', 'numeric'],
        ];
    }
}
