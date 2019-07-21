<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

Route::get('/', function () {
    return \redirect('login');
});

Route::name('produtos.')->prefix('produtos')->group(function (){

    Route::get('todos','ProdutosController@viewTodosProdutos')->name('viewTodosProdutos');
    Route::get('atualizar/{id?}','ProdutosController@viewCadastrarAtualizar')->name('viewAtualizarProdutos');
    Route::get('cadastrar', 'ProdutosController@viewCadastrarAtualizar')->name('viewCadastrarAtualizar');
    Route::post('cadastrar', 'ProdutosController@cadastrar')->name('cadastrar');
    Route::post('atualizar/{id}', 'ProdutosController@atualizar')->name('atualizar');

});

Route::name('pedidos.')->prefix('pedidos')->group(function (){

    Route::get('todos','PedidosController@viewTodosPedidos')->name('viewTodosPedidos');
    Route::post('cadastrar','PedidosController@cadastrar')->name('cadastrar');
});

Route::get('viewTrocarSenha/{token}', 'LoginController@viewTrocarSenha')->name('viewTrocarSenha');
Route::post('recuperarSenha', 'LoginController@recuperarSenha')->name('recuperarSenha');
Route::post('trocarSenha/{token}', 'LoginController@trocarSenha')->name('trocarSenha');

Route::get('login', 'LoginController@viewLogin')->name('viewLogin');
Route::get('sair', 'LoginController@getSair')->name('getSair');
Route::post('login', 'LoginController@login')->name('login');

    Route::name('usuarios.')->prefix('usuarios')->group(function () {

        Route::get('todos', 'UsuariosController@viewTodos')->name('todos');
        Route::get('registrar', 'UsuariosController@viewRegistrarAtualizar')->name('registrar');
        Route::get('editar/{id?}', 'UsuariosController@viewRegistrarAtualizar')->name('editar');
        Route::get('perfil', 'UsuariosController@viewPerfilUsuarios')->name('viewPerfilUsuarios');
        Route::post('perfil/atualizar', 'UsuariosController@viewPerfilUsuarios')->name('viewPerfilUsuarios');
        Route::post('perfil', 'UsuariosController@atualizarperfilUsuarios')->name('atualizarperfilUsuarios');
        Route::post('registrar', 'UsuariosController@Registrar')->name('registrar');
        Route::post('atualizar/{id}', 'UsuariosController@atualizar')->name('atualizar');

    });



