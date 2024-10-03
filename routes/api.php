<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\HandleCors;

/* ---------------------------------- Home ---------------------------------- */
Route::middleware(HandleCors::class)->get('/', [ProdutoController::class, 'index']);

