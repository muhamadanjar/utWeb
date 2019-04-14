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

Route::get('jalan', 'ApiCtrl@getDTJalan')->name('api.getdtjalan');
Route::get('jalankondisi/dt', 'ApiCtrl@getDTJalanKondisiJalan')->name('api.getdtjalankondisi');
Route::get('djalan/dt/{id}', 'ApiCtrl@getDetilJalanDT')->name('api.getdjalandt');

Route::get('/formskj/summary/{retak_luas}/{retak_lebar}/{jumlah_lubang}/{bekasroda}', 'ApiCtrl@getskjTableSummary');
Route::get('/formskj/sdiiri', 'ApiCtrl@getSdiIri');

Route::get('diagramtahunan', 'ApiCtrl@getDiagramTahunan');
Route::get('diagramtahunanbiaya', 'ApiCtrl@getDiagramTahunanNominal');
Route::get('statistiktahun','ApiCtrl@statistiktahun');

Route::get('piechartjenisjalan','ApiCtrl@getChartJenisJalan');
Route::get('piechartkondisijalan','ApiCtrl@getChartKondisiJalan');

Route::get('jalan-data','ApiCtrl@getJalan');
Route::get('kondisi-jalan','ApiCtrl@getKondisiJalanDetil');

