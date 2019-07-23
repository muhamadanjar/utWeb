<?php

Route::get('/', function () {
	// return view('welcome');
	return redirect('home');
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
	Route::get('dashboard/statistik','DashboardCtrl@getStatistikView');
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
	Route::post('trip_job/post','TripCtrl@post')->name('trip_job.post');
	Route::get('trip_job_data','TripCtrl@get_data');
	Route::get('trip_job/{trip_id}/detail','TripCtrl@get_detail');
	
	Route::resource('reviews','ReviewCtrl');
	Route::resource('driver','DriverCtrl');
	Route::post('driver','DriverCtrl@post')->name('driver.post');
	Route::post('driver/change_photo','DriverCtrl@change_photo')->name('driver.change_photo');

	Route::resource('services','ServiceCtrl');
	Route::resource('packages','PackageCtrl',['only'=>['index']]);
	Route::get('packages/create/{type?}','PackageCtrl@create')->name('packages.create');
	Route::get('packages/edit/{id}/{type?}','PackageCtrl@edit')->name('packages.edit');
	Route::post('packages-post/{type?}','PackageCtrl@post')->name('packages.post');
	Route::post('packages/{type?}/na','PackageCtrl@na')->name('packages.na');
	Route::get('packages-list/{type?}','PackageCtrl@list')->name('packages.list');
	Route::post('packages-upload','PackageCtrl@upload')->name('packages.upload');
	Route::delete('packages/{id}','PackageCtrl@destroy')->name('packages.destroy');
	Route::resource('typevehicle','VehicleTypeCtrl',['only'=>['index','create','edit','destroy']]);
	Route::post('typevehicle/post','VehicleTypeCtrl@post')->name('typevehicle.post');
	Route::post('typevehicle/upload','VehicleTypeCtrl@upload')->name('typevehicle.upload');

	//route customer
	Route::resource('customer', 'CustomerCtrl', ['only' => ['index', 'create', 'edit', 'destroy']]);
	Route::post('customer/post','CustomerCtrl@post')->name('customer.post');
	Route::get('customer/{id}/edit', 'CustomerCtrl@edit')->name('customer.edit');
	Route::post('customer/{id}/update','CustomerCtrl@update')->name('customer.update');

	Route::post('customer/addsaldo','CustomerCtrl@add_saldo')->name('customer.addsaldo');
	Route::get('customer/request_saldo','CustomerCtrl@request_saldo')->name('customer.request_saldo');
	Route::post('customer/accept_request_saldo','CustomerCtrl@accept_request_saldo')->name('customer.accept_request_saldo');


	//route req saldo
	Route::resource('reqsaldo', 'ReqSaldoCtrl', ['only' => ['index', 'create', 'edit', 'destroy','konfirmasi']]);
	Route::post('reqsaldo/post','ReqSaldoCtrl@post')->name('reqsaldo.post');
	Route::post('reqsaldo/{id}/konfirmasi','ReqSaldoCtrl@konfirmasi')->name('reqsaldo.konfirmasi');
	Route::get('reqsaldo/{id}/edit', 'ReqSaldoCtrl@edit')->name('reqsaldo.edit');
	Route::post('reqsaldo/{id}/update','ReqSaldoCtrl@update')->name('reqsaldo.update');	


	
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
