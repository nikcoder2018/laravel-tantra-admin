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

Auth::routes();

Route::get('/', 'DashboardController@index');
Route::get('/dashboard', 'DashboardController@index');
Route::get('/topup', 'TopupController@index');
Route::get('/topup/packages', 'TopupController@packages');
Route::get('/players', 'PlayersController@index');
Route::get('/staffs', 'StaffsController@index');
Route::get('/events', 'EventController@index');
Route::get('/announcements', 'AnnouncementsController@index');

Route::post('/topup/packages/store', 'TopupController@packages_store');

Route::get('/topup/packages/archives', 'TopupController@archived');
Route::get('/topup/packages/archive/{id}', 'TopupController@package_archive');
Route::get('/topup/packages/undo/{id}', 'TopupController@package_undo');

Route::get('/taneys', 'PlayersController@taneys');
Route::post('/taneys/add', 'PlayersController@addtaney');
Route::post('/taneys/remove', 'PlayersController@removetaney');
