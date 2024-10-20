<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/* ---------------------------------- Home ---------------------------------- */
// Route::get('/', [ProdutoController::class, 'index']);
// Route::get('/produto/{produto}', [ProdutoController::class, 'show']);

Route::resource('produto', ProdutoController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do produto não encontrada'], 404);
})->except(['create', 'store', 'edit', 'update', 'destroy']);

// Verb         |        URI             |  Action      |   Route Name         |        Usarei?         |   Pra que serve?        |
// GET	          /produto	                index         	produto.index      |        Sim             |   Listar todos          |
// GET            /produto/{Produto}	    show          	produto.show       |        Sim             |   Exibir um             |
// GET	          /produto/create	        create        	produto.create     |        Não             |   Formulário de criação |
// POST	          /produto              	store         	produto.store      |        Não             |   Salvar novo           |
// GET	          /produto/{Produto}/edit 	edit          	produto.edit       |        Não             |   Formulário de edição  |
// PUT/PATCH      /produto/{Produto}        update	        produto.update     |        Não             |   Atualizar             |
// DELETE	      /produto/{Produto}        destroy	        produto.destroy    |        Não             |   Excluir               |

Route::resource('usuario', UsuarioController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do usuário não encontrada'], 404);
})->except(['index', 'create', 'edit']);

// Verb         |        URI             |  Action      |   Route Name         |        Usarei?         |   Pra que serve?        |
// GET	          /usuario	                index         	usuario.index      |        Não             |   Listar todos          |
// GET            /usuario/{Usuario}	    show          	usuario.show       |        Sim             |   Exibir um             |
// GET	          /usuario/create	        create        	usuario.create     |        Não             |   Formulário de criação |
// POST	          /usuario              	store         	usuario.store      |        Sim             |   Salvar novo           |
// GET	          /usuario/{Usuario}/edit 	edit          	usuario.edit       |        Não             |   Formulário de edição  |
// PUT/PATCH      /usuario/{Usuario}        update	        usuario.update     |        Não             |   Atualizar             |
// DELETE	      /usuario/{Usuario}        destroy	        usuario.destroy    |        Não             |   Excluir               |

