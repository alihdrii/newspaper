<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource('news', 'API\newsController');

Route::apiResource('category', 'API\categoryController');

Route::apiResource('notification', 'API\notificationController');

Route::middleware('auth:api')->get('getNotifications', 'API\notificationController@getNotifications');

Route::middleware('auth:api')->get('unreadNotifications', 'API\notificationController@unreadNotifications');

Route::middleware('auth:api')->put('markAsReadNotification', 'API\notificationController@markAsReadNotification');

Route::middleware('auth:api')->get('readNotifications', 'API\notificationController@readNotifications');

Route::get('newspaperVerAd', 'API\advertisingController@newspaperVerAd');

Route::get('newspaperHorAd', 'API\advertisingController@newspaperHorAd');

Route::get('getPoll', 'API\pollController@getPoll');

Route::get('newspaperSlidebarNews', 'API\newsController@newspaperSlidebarNews');

Route::get('newspaperBestNews', 'API\newsController@newspaperBestNews');

Route::get('newspaperHeadlineNews', 'API\newsController@newspaperHeadlineNews');

Route::get('newspaperSuggestionNews', 'API\newsController@newspaperSuggestionNews');

Route::get('newspaperHotNews', 'API\newsController@newspaperHotNews');

Route::get('newsHorAd', 'API\advertisingController@newsHorAd');

Route::get('newsSlidebarNews', 'API\newsController@newsSlidebarNews');

Route::get('newsVerAd', 'API\advertisingController@newsVerAd');
