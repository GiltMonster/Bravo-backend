<?php

use App\Http\Controllers\ProdutoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CarrinhoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\PedidoController;

/* ---------------------------------- Home ---------------------------------- */
// Route::get('/', [ProdutoController::class, 'index']);
// Route::get('/produto/{produto}', [ProdutoController::class, 'show']);

/* ---------------------------------- Login ---------------------------------- */
Route::prefix('auth')->group(function () {
    Route::post('login', [AuthController::class, 'login']);
    Route::middleware('api')->get('verify', [AuthController::class, 'verifyToken']);
});


Route::middleware('api')->group(function () {
    Route::resource('produto', ProdutoController::class)->missing(function (Request $request) {
        return response()->json(['message' => 'Rota do produto não encontrada'], 404);
    })->except(['create', 'store', 'edit', 'update', 'destroy']);
    Route::get('search/{search}', [ProdutoController::class, 'search']);
});


// Verb         |        URI             |  Action      |   Route Name         |        Usarei?         |   Pra que serve?        |
// GET	          /produto	                index         	produto.index      |        Sim             |   Listar todos          |
// GET            /produto/{Produto}	    show          	produto.show       |        Sim             |   Exibir um             |
// GET	          /produto/create	        create        	produto.create     |        Não             |   Formulário de criação |
// POST	          /produto              	store         	produto.store      |        Não             |   Salvar novo           |
// GET	          /produto/{Produto}/edit 	edit          	produto.edit       |        Não             |   Formulário de edição  |
// PUT/PATCH      /produto/{Produto}        update	        produto.update     |        Não             |   Atualizar             |
// DELETE	      /produto/{Produto}        destroy	        produto.destroy    |        Não             |   Excluir               |

Route::middleware('api')->resource('usuario', UsuarioController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do usuário não encontrada'], 404);
})->except(['index', 'create', 'edit']);

// Verb         |        URI             |  Action      |   Route Name         |        Usarei?         |   Pra que serve?        |
// GET	          /usuario	                index         	usuario.index      |        Não             |   Listar todos          |
// GET            /usuario/{Usuario}	    show          	usuario.show       |        Sim             |   Exibir um             |
// GET	          /usuario/create	        create        	usuario.create     |        Não             |   Formulário de criação |
// POST	          /usuario              	store         	usuario.store      |        Sim             |   Salvar novo           |
// GET	          /usuario/{Usuario}/edit 	edit          	usuario.edit       |        Não             |   Formulário de edição  |
// PUT/PATCH      /usuario/{Usuario}        update	        usuario.update     |        Sim             |   Atualizar             |
// DELETE	      /usuario/{Usuario}        destroy	        usuario.destroy    |        Não             |   Excluir               |

Route::middleware('api')->resource('endereco', EnderecoController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do endereço não encontrada'], 404);
})->except(['index', 'create', 'edit']);


Route::middleware('api')->resource('carrinho', CarrinhoController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do carrinho não encontrada'], 404);
})->except(['index','create', 'edit']);


Route::middleware('api')->resource('pedido', PedidoController::class)->missing(function (Request $request) {
    return response()->json(['message' => 'Rota do pedido não encontrada'], 404);
})->except(['index','create', 'edit']);


Route::get('/', function () {
    return response()->json(['status' => 'API rodando!']);
});

Route::get('/health', fn () => ['status' => 'ok']);
