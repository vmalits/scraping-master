<?php

use Illuminate\Support\Facades\Route;

Route::fallback(function () {
    return response()->json([
        'message' => 'This route does not exists!'
    ]);
});
Route::group([
    'namespace' => 'Api\Auth',
    'prefix' => 'auth',
], function () {
    Route::post('register', 'RegisterController');
    Route::post('login', 'LoginController');
    Route::get('email/verify/{id}', 'VerificationController@verify')->name('verification.verify');
    Route::middleware('auth:sanctum')->group(function () {
        Route::get('email/resend', 'VerificationController@resend')->name('verification.resend');
        Route::post('logout', 'LogOutController');
        Route::get('me', 'MeController');
    });
});

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('campaigns', 'Api\CampaignController');
    Route::get('proxies/available-types', 'Api\ProxyController@availableTypes');
    Route::apiResource('proxies', 'Api\ProxyController');
});
