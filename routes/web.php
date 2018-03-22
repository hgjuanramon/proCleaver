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

Route::get('/', "UseEmployeeController@index");
Route::post('/getEmployees', "UseEmployeeController@getAllList");
Route::post('/employee-save', "UseEmployeeController@save");
Route::post('/employee-delete', "UseEmployeeController@delete");

