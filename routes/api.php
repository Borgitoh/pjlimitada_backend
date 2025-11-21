<?php

use App\Http\Controllers\AvaliacaoController;
use App\Http\Controllers\BodykitController;
use App\Http\Controllers\CategoriaPecaController;
use App\Http\Controllers\CupomDescontoController;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\ItensPedidoController;
use App\Http\Controllers\ItensSolicitacaoServicoController;
use App\Http\Controllers\PagamentoController;

use App\Http\Controllers\PecaController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\RastreamentoPedidoController;
use App\Http\Controllers\ServicoController;
use App\Http\Controllers\SolicitacaoServicoController;
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
    Route::get('/get-user', [AuthController::class, 'listUsersAllowed']);
    Route::put('/update-user/{id}', [AuthController::class, 'updateUser']);
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
