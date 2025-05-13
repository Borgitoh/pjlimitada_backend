<?php

namespace App\Http\Controllers;

use App\Models\marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Marca::all();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'imagem' => 'nullable|string',
        ]);

        return Marca::create($data);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
         return Marca::with('modelos')->findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(marca $marca)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
          $marca = Marca::findOrFail($id);

        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'imagem' => 'nullable|string',
        ]);

        $marca->update($data);
        return $marca;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Marca::destroy($id);
        return response()->json(['message' => 'Marca removida com sucesso.']);
    }
}
