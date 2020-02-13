<?php

namespace App\Components;

class ApiError
{
    const PARAMS_ERROR = [-400, '参数错误'];
    const ILLEGAL_REQUEST = [-500, '非法请求'];
    const UNAUTHORIZED = [-419, '认证失败'];

    /**
     * 登录授权相关错误码
     */
    const USER_PASSWORD_ERROR = [-1001, '用户密码错误'];
    const UNKONW_ROLE = [-1001, '未知角色'];
}
