<?php

namespace App\Components;

class ApiError
{
    const PARAMS_ERROR = [-400, '参数错误'];
    const ILLEGAL_REQUEST = [-500, '非法请求'];
    const UNAUTHORIZED = [-500, '认证失败'];

}
