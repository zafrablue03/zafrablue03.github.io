<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
{
    protected $rules = [
        'user'  => [
            'name'                  =>  'required|min:2|max:80',
            'is_featured_to_team'   =>  ''
        ],
        'profile' => [
            'about'     =>  'sometimes|min:2',
            'title'     =>  '',
            'image'     =>  'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=50,max_width=2000, min_height=50, max_height=2000',
            'facebook'  =>  '',
            'twitter'   =>  '',
            'instagram' =>  ''
        ]
    ];
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
        if($this->get('action') == 'user')
        {
            return [
                'email' =>  'required|email|unique:users,email,'.$this->user_id
            ];
        }
        return $this->rules[$this->action];
    }
}
