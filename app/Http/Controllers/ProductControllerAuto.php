<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductControllerAuto extends Controller
{

    private const PRODUCTS = ['Batata', 'Tomate', 'Cenoura'];

    protected $request, $user;

    public function __construct(Request $request)
    {
        //dd($request->var1);  //Inserir na URL ?var1=valor
        //dd($request);
        $this->request = $request;

        //$this->middleware('auth')->except('show'); //Colocaoca o filtro em todos exceto em 1
        //$this->middleware('auth')->only(['create', 'store', 'show']);  //Este tipo de miidleware/filtro diz que havera autenticação apenas na pagina do create
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produtosJSON = json_encode(ProductControllerAuto::PRODUCTS);
        $produtos = ProductControllerAuto::PRODUCTS;
        $estoque = 150;
        //return ProductControllerAuto::PRODUCTS;
        return view('admin.pages.products.index', compact('produtos', 'estoque', 'produtosJSON'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        dd("Cadastrando....");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.pages.products.show', compact('id'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.pages.products.edit', compact('id'));
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
        dd("Editando o Produto {$id}");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        dd("Deletando  Produto {$id}....");
    }
}
