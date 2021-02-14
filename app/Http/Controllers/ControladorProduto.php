<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Produto;
use App\Categoria;

class ControladorProduto extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexView()
    {
        $prods = Produto::all();
        return view('produtos', compact('prods'));
    }

    public function index(){
        $prods = Produto::all();
        return $prods->toJson();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cats = Categoria::all();
        return view("novoproduto", compact('cats'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $prod = new Produto();
        $prod->nome = $request->input("nome");
        $prod->categoria_id = $request->input("categoria_id");
        $prod->estoque = $request->input("estoque");
        $prod->preco = $request->input("preco");
        $prod->imagem = $request->input("imagem");
        $prod->save();
        return json_encode($prod);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $prod = Produto::find($id);
        if($prod){
            return json_encode($prod);
        }
        return response("Produto não encontrado", 404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $prod = Produto::find($id);
        $cats = Categoria::all();
        return view("editarproduto", compact('prod', 'cats'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $prod = Produto::find($id);
        if($prod){
            $prod->nome = $request->input("nome");
            $prod->categoria_id = $request->input("categoria_id");
            $prod->estoque = $request->input("estoque");
            $prod->preco = $request->input("preco");
            $prod->imagem = $request->input("imagem");
            $prod->save();
            return json_encode($prod);
        }
        return response("Produto não encontrado", 404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $prod = Produto::find($id);
        if($prod){
            $prod->delete();
            return response('OK', 200);
        }
        return response('Produto não encontrado', 404);
    }
}
