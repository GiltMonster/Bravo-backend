<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------- Home ---------------------------------- */
Route::get('/', [ProdutoController::class, 'index']);
Route::get('/produto/{produto}', [ProdutoController::class, 'show']);

