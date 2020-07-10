<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace' => 'Api\Auth',
    'prefix' => 'auth',
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::middleware('auth:sanctum')->group(function () {
        Route::post('logout', 'LogOutController');
        Route::get('me', 'MeController');
    });
});
