<?php

use Illuminate\Http\Request;

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

Route::get('/getprovinsi', 'ApiCtrl@getprovinsi');
Route::get('/getkabupaten/{id}', 'ApiCtrl@getkabupaten');
Route::get('/getkecamatan/{id?}', 'ApiCtrl@getkecamatan');
Route::get('/getdesa/{id}', 'ApiCtrl@getdesa');

Route::post('login', 'ApiCtrl@login');
Route::post('register', 'ApiCtrl@register');
Route::post('user/details', 'ApiCtrl@details');
Route::post('user/update_position', 'ApiCtrl@userUpdateLocation');
Route::post('booking','ApiCtrl@PostBooking');
Route::get('user/location','ApiCtrl@GetUserLocation');
Route::get('type_car','ApiCtrl@GetTypeCar');
Route::get('get_promo','ApiCtrl@GetPromo');
Route::get('get_settings','ApiCtrl@GetSettings');

