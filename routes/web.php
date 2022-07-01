<?php

use App\Http\Controllers\Home;
use App\Http\Controllers\Order;
use Illuminate\Support\Facades\Route;

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

/**
 * Rotas principais
 */
Route::prefix(null)->group(function() {

    /**
     * Rota index (lista)
     */
    Route::get('/', [Home::class, 'index']);
    
    /**
     * Rota Criar Pedido
     */
    Route::post('/criar-pedido', [Order::class, 'postOrder']);
    Route::get('/criar-pedido', [Order::class, 'index']);

    /**
     * Rota Editar Pedido
     */
    Route::post('/editar-pedido', [Order::class, 'updateOrder']);
    Route::get('/editar-pedido/{hash}', [Order::class, 'viewOrder']);

    /**
     * Rota Excluir pedido
     */
    Route::post('/excluir-pedido', [Order::class, 'deleteOrder']);
});
