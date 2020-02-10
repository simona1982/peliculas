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



Route::redirect('/', '/login');


Route::get('logo-company', function(){

	// read height of image
	$height = Image::make('images/Wings_&_Beer_Logo_Welcome.jpg')->height();

	// read width of image
	$width = Image::make('images/Wings_&_Beer_Logo_Welcome.jpg')->width();

    $img = Image::make('images/Wings_&_Beer_Logo_Welcome.jpg')->resize($width/2, $height/2);
    
    return $img->response('jpg');
});

Route::group(['middleware' => 'web'], function () {

	Auth::routes();

	Route::get('/dashboard', 'HomeController@index');


	// Puntos de Venta
	Route::get('points-sale/all-points', 'PointSaleController@getAllPoints')->name('points-sale.all');
	Route::get('points-sale/{id}/get-point', 'PointSaleController@getPoint')->name('points-sale.get');
	Route::get('points-sale/list-points-sale', 'PointSaleController@getListPointsSales')->name('points-sale.list');
	Route::resource('points-sale', 'PointSaleController');

	// Analitica
	Route::get('/analytics', 'AnalyticsController@index');

	// Usuarios
	Route::get('users/all-users', 'UserController@getAllUsers')->name('users.all');
	Route::get('users/{id}/get-user', 'UserController@getUser')->name('users.get');
	Route::get('users/list-users', 'UserController@getListUsers')->name('users.list');
	Route::resource('users', 'UserController');


	// Reservaciones
	Route::get('reservations/list-reservations', 'ReservationController@getListReservations')->name('reservations.list');
	Route::resource('reservations', 'ReservationController');

	// Cierres
	Route::get('closures/list-closures', 'ClosureController@getListClosures')->name('closures.list');
	Route::resource('closures', 'ClosureController');

	// Clientes
	Route::get('clients/all-clients', 'ClientController@getAllClients')->name('clients.all');
	Route::get('clients/{id}/get-client', 'ClientController@getClient')->name('clients.get');
	Route::get('clients/list-clients', 'ClientController@getListClients')->name('clients.list');
	Route::resource('clients', 'ClientController');

	// Authentication Routes...
	/*Route::get('login', 'Auth\AuthController@showLoginForm');
	Route::post('login', 'Auth\AuthController@login');
	Route::get('logout', 'Auth\AuthController@logout');

	// Registration Routes...
	Route::get('register', 'Auth\AuthController@showRegistrationForm');
	Route::post('register', 'Auth\AuthController@register');

	// Password Reset Routes...
	Route::get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
	Route::post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
	Route::post('password/reset', 'Auth\PasswordController@reset');*/

	//Route::get('/home', 'HomeController@index')->name('home');

});


Route::get('image-user/{filename}', function($filename) {
	$img = Image::make(storage_path('app/public/users/' . $filename));
    return $img->response('jpg');
});

Route::get('image-client/{filename}', function($filename) {
	$img = Image::make(storage_path('app/public/clients/' . $filename));
    return $img->response('jpg');
});

Route::get('image-point/{filename}', function($filename) {
	$img = Image::make(storage_path('app/public/points/' . $filename));
    return $img->response('jpg');
});

