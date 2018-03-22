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

Route::post('employee', "EmployeeController@getAllList")->name("Obtener Lista de empleados");
Route::post('employee-count', "EmployeeController@countList")->name("Obtener Lista completa");
Route::post('employee-create', "EmployeeController@create")->name("Crear empleado");
Route::post('employee-update/{id}', "EmployeeController@update")->name("Actualizar empleado");
Route::delete('employee-delete/{id}', "EmployeeController@delete")->name("Eliminar empleado");

Route::get('skills', "EmployeeController@getDataSkills")->name("Obtener Lista de habilidades");
