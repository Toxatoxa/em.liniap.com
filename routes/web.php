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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::resource('/delivery', 'DeliveryController', ['only' => ['index', 'create', 'show']]);
    Route::post('/delivery/send', 'DeliveryController@send')->name('delivery.send');
    Route::get('/delivery/{id}/undo', 'DeliveryController@undo')->name('delivery.undo');
    Route::get('/delivery/{id}/errors', 'DeliveryController@errors')->name('delivery.errors');
    Route::get('/delivery/{id}/resend', 'DeliveryController@resend')->name('delivery.resend');
    Route::resource('/accounts', 'AccountsController');
    Route::resource('/developers', 'DevelopersController', ['only' => ['index', 'update']]);
    Route::get('/developers/{id}/send', 'DevelopersController@send')->name('developers.send');
    Route::get('/developers/{id}/change_status/{status}', 'DevelopersController@changeStatus')->name('developers.changeStatus');
    Route::get('/developers/find_contacts', 'DevelopersController@findContacts')->name('developers.findContacts');
    Route::resource('/templates', 'TemplatesController');
    Route::post('/upload/image', 'UploadController@image');

    Route::post('/upload/images', 'UploadController@images');
});