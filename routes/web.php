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
Route::prefix('pessoa')->group(function(){
    Route::get('criar','PessoaController@create')->name('pessoa.criar');
    Route::post('salvar','PessoaController@store')->name('pessoa.salvar');
    Route::post('excluir','PessoaController@destroy')->name('pessoa.excluir');
    Route::get('editar/{id}','PessoaController@edit')->name('pessoa.editar');
    Route::post('atualizar','PessoaController@update')->name('pessoa.atualizar');
    Route::get('visualizar/{id}','PessoaController@show')->name('pessoa.visualizar');
});

