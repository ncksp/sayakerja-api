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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix' => 'users'], function () {
    Route::get('/','UserController@index');
    Route::get('/{id}','UserController@show');
    Route::get('/{id}/application','ApplicationController@my_application');
    Route::get('/{id}/company','CompanyController@user_company');
    Route::get('/{id}/company/application','ApplicationController@application_to_user_company');
    Route::post('/','UserController@store');
    Route::delete('/{id}','UserController@destroy');
    Route::put('/{id}','UserController@update');
});

Route::group(['prefix' => 'company'], function () {
    Route::get('/','CompanyController@index');
    Route::get('/{id}','CompanyController@show');
    Route::post('/','CompanyController@store');
    Route::delete('/{id}','CompanyController@destroy');
    Route::put('/{id}','CompanyController@update');
    Route::get('/{id}/jobs','CompanyController@jobs');
});

Route::group(['prefix' => 'jobs'], function () {
    Route::get('/','JobController@index');
    Route::get('/{id}','JobController@show');
    Route::post('/','JobController@store');
    Route::delete('/{id}','JobController@destroy');
    Route::put('/{id}','JobController@update');
});

Route::group(['prefix' => 'application'], function () {
    Route::post('/','ApplicationController@store');
});

