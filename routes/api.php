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
    Route::post('attachment/import/student', 'ImportController@student');
    // 导入考试站
    Route::post('attachment/import/exam-site', 'ImportController@examSite');
    // 导入试题
    Route::post('attachment/import/question', 'ImportController@question');
    // 导入考评员|督导员
    Route::any('attachment/import/supervisor', 'ImportController@supervisor');
    // 导出考试题
    Route::any('attachment/export/question', 'ExportController@question');
});

Route::get('/exam-site', 'ExamSiteController@index');


// 资源路由
Route::resources([
    'training-plans' => 'TrainingPlanController',
    'exam-rooms' => 'ExamRoomController',
    'questions' => 'QuestionController'
]);

