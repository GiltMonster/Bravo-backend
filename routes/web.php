<?php

use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProdutoController::class, 'home']);
Route::get('/categoria', [CategoriaController::class, 'index']);
Route::get('/produtos', [ProdutoController::class, 'index']);

Route::get('/categoria/{categoria}', [CategoriaController::class, 'show']);
