<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserLoginRequest extends AbstractRequest
{

    public function rules()
    {
        return [
            'username' => 'required',
            'password' =>'required',
            'role' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'role' => '角色',
        ];
    }


}
