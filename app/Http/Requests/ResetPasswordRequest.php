<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResetPasswordRequest extends AbstractRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'password' => 'required',
            'origin_password' => 'required'
        ];
    }

    public function attributes()
    {
        return [
            'origin_password' => '原始密码'
        ];
    }
}
