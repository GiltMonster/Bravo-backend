<?php

use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProdutoController::class, 'index']);
