<?php

Route::get('/', function () {
	// return view('welcome');
	return redirect()->route('gerbang.login');
});	
Route::get('/home', 'HomeController@index')->name('home');
Route::get('/hubungi', 'HomeController@hubungi')->name('hubungi');
Route::post('/hubungi', 'HomeController@posthubungi')->name('hubungi');
Route::group(['prefix' => 'map', 'as' => 'map.'], function () {
	Route::get('/', 'MapCtrl@getIndex')->name('index');
	Route::get('/viewer', 'MapCtrl@getViewer')->name('esri');
	Route::get('/3d', 'MapCtrl@get3D')->name('3desri');
	Route::get('/op', 'MapCtrl@getOpMap')->name('map.op');
	Route::get('/getdata', 'MapCtrl@getData')->name('getdata');
	Route::get('/getdata/group', 'MapCtrl@getDataGroup')->name('getdatagroup');
	Route::get('/searchdata', 'MapCtrl@searchData')->name('mapsearchdata');
	Route::get('/info/{kodelayer}', 'MapCtrl@getLayerInformasi')->name('getinfo');
});
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::post('password/reset', 'Auth\ResetPasswordController@reset');
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');

Route::group(['prefix' => 'backend', 'as' => 'backend.', 'namespace' => 'Backend', 'middleware' => 'auth'], function () {
	Route::get('/', 'DashboardCtrl@getIndex')->name('index');
	Route::get('dashboard/index', ['as' => 'dashboard.index', 'uses' => 'DashboardCtrl@getIndex']);
	Route::get('notifikasi', ['as' => 'notifikasi', 'uses' => 'DashboardCtrl@getNotifikasi']);
	Route::group(['prefix' => 'dokumen', 'as' => 'dokumen.'], function () {
		Route::get('/', 'DokumenCtrl@getIndex')->name('index');
		Route::get('/tambah', 'DokumenCtrl@getTambah')->name('tambah');
		Route::get('/array', 'DokumenCtrl@getInformasiArray')->name('getdata');
		Route::get('/{id}/edit', 'DokumenCtrl@getEdit')->name('edit');
		Route::delete('/{id}/delete', 'DokumenCtrl@postDelete')->name('delete');
		Route::post('/post', 'DokumenCtrl@postDokumen')->name('post');
		Route::get('{id}/download', 'DokumenCtrl@postDownload')->name('download');
		Route::post('upload', 'DokumenCtrl@upload')->name('upload');
	});

	Route::resource('trip_job','TripCtrl');
	

	Route::resource('reviews','ReviewCtrl');
	Route::resource('driver','DriverCtrl');
	Route::resource('services','ServiceCtrl');

	
    //Link
	// Route::resource('link', 'LinkCtrl', ['only' => ['index', 'create', 'edit', 'destroy']]);
	// Route::post('link/post', 'LinkCtrl@postLink')->name('link.post');
	// Route::post('link/postimage', 'LinkCtrl@postImage')->name('link.postimage');

	Route::resource('pengumuman', 'PengumumanCtrl', ['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('pengumuman/post', 'PengumumanCtrl@postPengumuman')->name('pengumuman.post');

	Route::resource('promo', 'PromoCtrl', ['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('promo/post', 'PromoCtrl@post')->name('promo.post');
	Route::post('promo/upload', 'PromoCtrl@upload')->name('promo.upload');

	Route::resource('laporan', 'LaporanCtrl', ['only' => ['index']]);
	// User Profile
});
