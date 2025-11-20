<?php

use Illuminate\Support\Facades\Route;

Route::apiResource('peca', 'App\Http\Controllers\Api\PecaController');
Route::apiResource('bodykit', 'App\Http\Controllers\Api\BodykitController');
Route::apiResource('servico', 'App\Http\Controllers\Api\ServicoController');
Route::apiResource('pedido', 'App\Http\Controllers\Api\PedidoController');
Route::apiResource('itenspedido', 'App\Http\Controllers\Api\ItensPedidoController');
Route::apiResource('solicitacaoservico', 'App\Http\Controllers\Api\SolicitacaoServicoController');
Route::apiResource('itenssolicitacaoservico', 'App\Http\Controllers\Api\ItensSolicitacaoServicoController');
Route::apiResource('endereco', 'App\Http\Controllers\Api\EnderecoController');
Route::apiResource('rastreamentopedido', 'App\Http\Controllers\Api\RastreamentoPedidoController');
Route::apiResource('categoriapeca', 'App\Http\Controllers\Api\CategoriaPecaController');
Route::apiResource('marca', 'App\Http\Controllers\Api\MarcaController');
Route::apiResource('pagamento', 'App\Http\Controllers\Api\PagamentoController');
Route::apiResource('cupomdesconto', 'App\Http\Controllers\Api\CupomDescontoController');
Route::apiResource('avaliacao', 'App\Http\Controllers\Api\AvaliacaoController');
