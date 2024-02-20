<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserAuthRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'access_token' => 'required|string',
            'id' => 'required|integer',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'city' => 'required|string',
            'country' => 'required|string',
            'sig' => 'required|string',
        ];
    }
}
