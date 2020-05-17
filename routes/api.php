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

Route::get('qoutes', 'QouteController@getAll');
Route::get('qoute/details/{id}', 'QouteController@getMatchingId');
Route::post('qoute', 'QouteController@create');
Route::put('qoute/update/{id}', 'QouteController@update');
Route::delete('qoute/delete/{id}', 'QouteController@delete');
