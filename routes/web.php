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
Route::get('pessoa','PessoaController@index')->name('pessoa.inicial');
Route::get('pessoa/criar','PessoaController@create')->name('pessoa.criar');
Route::post('pessoa/salvar','PessoaController@store')->name('pessoa.salvar');
