<?php

use App\Http\Controllers\Api\AvaliacaoController;
use App\Http\Controllers\Api\BodykitController;
use App\Http\Controllers\Api\CategoriaPecaController;
use App\Http\Controllers\Api\CupomDescontoController;
use App\Http\Controllers\Api\EnderecoController;
use App\Http\Controllers\Api\ItensPedidoController;
use App\Http\Controllers\Api\ItensSolicitacaoServicoController;
use App\Http\Controllers\Api\PagamentoController;
use App\Http\Controllers\Api\PecaController;
use App\Http\Controllers\Api\PedidoController;
use App\Http\Controllers\Api\RastreamentoPedidoController;
use App\Http\Controllers\Api\ServicoController;
use App\Http\Controllers\Api\SolicitacaoServicoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\MarcaController;
use App\Http\Controllers\ModeloController;
use App\Http\Controllers\ProdutoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;




Route::get('/', function () {
    return response()->json([
        'message' => 'PJ_LIMITADA'
    ]);
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);
Route::apiResource('categorias', CategoriaController::class);



Route::middleware('auth:sanctum')->group(function () {
    Route::post('/change-password', [AuthController::class, 'changePassword']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::apiResource('marcas', MarcaController::class);
    Route::apiResource('modelos', ModeloController::class);
    Route::apiResource('produtos', ProdutoController::class);
    Route::apiResource('pecas', PecaController::class);
    Route::apiResource('bodykit', BodykitController::class);
    Route::apiResource('servico', ServicoController::class);
    Route::apiResource('pedido', PedidoController::class);
    Route::apiResource('itenspedido', ItensPedidoController::class);
    Route::apiResource('solicitacaoservico', SolicitacaoServicoController::class);
    Route::apiResource('itenssolicitacaoservico', ItensSolicitacaoServicoController::class);
    Route::apiResource('endereco', EnderecoController::class);
    Route::apiResource('rastreamentopedido', RastreamentoPedidoController::class);
    Route::apiResource('categoriapeca', CategoriaPecaController::class);
    Route::apiResource('pagamento', PagamentoController::class);
    Route::apiResource('cupomdesconto', CupomDescontoController::class);
    Route::apiResource('avaliacao', AvaliacaoController::class);

    Route::get('/perfil', function (Request $request) {
        return $request->user();
    });
});
