<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
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
        //$produtos = Product::all();  //Exibe todoso os valores no BD
        $produtos = Product::paginate(20);   //Exibe os 20 primeiros registros (default 15)  latest()->paginate() - Retorna os ultimos
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
    public function store(StoreUpdateProductRequest $request)  //Trocou a classe padrão Request pela a classe criada em Requests do Http
    {
        /*
        $request->validate([  //Este cpomando faz validações dos campos, na onde eles retornam a pagina caso não passem
            'name' => 'required|min:3|max:250',  //É obrigatório com min e max de caracteres
            'description' => 'nullable|min:3|max:10000',   //É opcional 
            'photo' => 'required|image'  //Valida para saber se o arquivo é uma imagem
        ]);
        */
        dd('OK');

        //Pegando Valores do Formulario
        //dd($request->input('name2', 'Valor de Campo Default'), $request->only(['name', 'description']),$request->has('name'), $request->name, $request->all(), $request->except(['description', '_token']));
        //input pega um valor default caso tal campo nao esteja definido
        
        //Pegando informação do Upload de arquivo
        //dd($request->file('photo'));   //Informações do arquivo, pode usar apenas $request->photo
        //dd($request->file('photo')->extension());  //Verifica a extensão do arquivo
        //dd($request->file('photo')->getClientOriginalName());  //Pega o nome original do arquivo

        if(($request->file('photo')->isValid())) { //Verifica se o arquivo é valido
            //dd($request->file('photo')->store('products'));   //Salva na pasta app por padrao e gera uma pasta products
            $nameFile = $request->name . '.' . $request->photo->extension();
            dd($request->photo->storeAs('products', $nameFile));  //Salva com um nome customizavel - Pode salvar em Public ou em Local
        }  
        
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
