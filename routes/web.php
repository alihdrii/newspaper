<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Support\Facades\Route;

//    return view('welcome');

Auth::routes(['verify' => true]);

Route::get('/' , 'retrieverController@newspaper');

Route::get('/advertising/redirect/{id}' , 'advertisingController@view_ad');

Route::get('/registery' , 'retrieverController@registery_page');

Route::get('/password/forget' , 'retrieverController@forget_password');

Route::get('/validation/email' , 'retrieverController@validation_email');

Route::get('/{cat}' , 'retrieverController@page');

Route::post('/get_more_news' , 'newsController@page_sidebar_more_news');

Route::get('/news/{id}/{slug_title}' , 'AppController@showNews');

Route::post('/submitPoll' , 'pollController@store');

Route::post('/markAsRead' , 'journalistController@markAsRead');

Route::post('/saveNews' , 'newsController@saveNews');

Route::post('/unSaveNews' , 'newsController@unSaveNews');

Route::post('/submitReport/{id}' , 'newsController@submitReport');
