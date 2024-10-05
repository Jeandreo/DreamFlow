<?php

use App\Http\Controllers\AuthApiController;
use App\Http\Controllers\FinancialTransactionsController;
use App\Http\Controllers\TransactionsApiController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Autenticação
Route::prefix('autenticacao')->group(function () {
    Route::post('/login', [AuthApiController::class, 'auth']);
});

// Transações
Route::prefix('financeiro')->group(function () {
    Route::get('/balanco', [TransactionsApiController::class, 'balance']);
    Route::get('/transacoes', [TransactionsApiController::class, 'transactions']);
    Route::get('/carteiras-e-cartoes', [TransactionsApiController::class, 'walletsCredits']);
    Route::post('/nova-transacao', [TransactionsApiController::class, 'newTransaction']);
    Route::get('/categorias/{type?}', [TransactionsApiController::class, 'categories']);
    Route::get('/visualizar/{id}', [TransactionsApiController::class, 'show']);
});