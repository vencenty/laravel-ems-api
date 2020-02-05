<?php

use Illuminate\Http\Request;


Route::group(['prefix' => 'auth'], function ($router) {
    Route::any('login', 'AuthController@login');
    Route::any('logout', 'AuthController@logout');
    Route::any('refresh', 'AuthController@refresh');
    Route::any('me', 'AuthController@me');

});
