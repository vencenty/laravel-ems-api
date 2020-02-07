<?php

use Illuminate\Http\Request;


// 认证接口
Route::group(['prefix' => 'auth'], function ($router) {
    // 登录成功
    Route::post('login', 'AuthController@login');
    // 退出
    Route::post('logout', 'AuthController@logout');
    // 刷新token
    Route::post('refresh', 'AuthController@refresh');
    // 重置密码
    Route::post('resetPassword', 'AuthController@resetPassword');
});


Route::namespace('Attachment')->group(function () {
    // 导入学生花名册
    Route::post('attachment/import/user', 'ImportController@user');
    // 导入考试站
    Route::post('attachment/import/exam-site', 'ImportController@examSite');

});

