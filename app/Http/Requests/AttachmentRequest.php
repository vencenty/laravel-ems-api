<?php

namespace App\Http\Requests;

use App\Rules\UserType;
use Illuminate\Foundation\Http\FormRequest;

class AttachmentRequest extends AbstractRequest
{


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'attachment' => 'required',
            'type' =>['required', new UserType()]
        ];
    }

    public function attributes()
    {
        return [
            'attachment' => '附件'
        ];
    }
}
