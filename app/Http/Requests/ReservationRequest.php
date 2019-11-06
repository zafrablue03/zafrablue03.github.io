<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReservationRequest extends FormRequest
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
            'date'                  =>  'date_format:Y-m-d|required',
            'time'                  =>  'date_format:H:i|required',
            'name'                  =>  'required|min:2|max:50',
            'email'                 =>  'required|email|min:3|max:80',
            'contact'               =>  'required|numeric|digits_between:11,15',
            'venue'                 =>  'required|min:2|max:90',
            'pax'                   =>  'required|numeric|min:10',
            'service_id'            =>  'required',
            'set_id'                =>  'required',
        ];
    }
}
