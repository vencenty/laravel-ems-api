<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadPhotoRequest extends AbstractRequest
{


    public function rules()
    {
        return [
            'photos' => ['required']
        ];
    }
}
