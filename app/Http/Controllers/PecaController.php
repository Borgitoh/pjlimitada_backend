<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Peca;

class PecaController extends Controller
{
    public function index() { return Peca::all(); }
    public function store(Request $request) {
        $data = $request->validate([
            'nome'=>'required','marca'=>'required','categoria'=>'required',
            'preco'=>'required|numeric','custo'=>'required|numeric',
            'descricao'=>'nullable','imagem'=>'nullable','estoque'=>'required|integer',
            'compatibilidade'=>'nullable|array','sku'=>'required|unique:pecas,sku',
            'ativo'=>'boolean'
        ]);
        return Peca::create($data);
    }
    public function show($id){ return Peca::findOrFail($id); }
    public function update(Request $request,$id){
        $peca=Peca::findOrFail($id);
        $peca->update($request->all());
        return $peca;
    }
    public function destroy($id){
        Peca::findOrFail($id)->delete();
        return response()->noContent();
    }
}

