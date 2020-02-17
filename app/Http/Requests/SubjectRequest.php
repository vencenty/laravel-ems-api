<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SubjectRequest extends AbstractRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'sn' => 'required',
            'name' => 'required',
        ];
    }

    public function attributes()
    {
        return [
            'sn' => '职业编号',
            'name' => '职业名称',
            'level' => '职业等级',
        ];
    }
}
