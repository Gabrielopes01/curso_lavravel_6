<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductControllerAuto extends Controller
{

    private const PRODUCTS = ['Batata', 'Tomate', 'Cenoura'];

    protected $request, $user;
    private $repostory;

    public function __construct(Request $request, Product $product)
    {
        //dd($request->var1);  //Inserir na URL ?var1=valor
        //dd($request);
        $this->request = $request;
        $this->repository = $product;

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
        dd('OK');
        */
        
        $data = $request->only('name', 'description', 'price'); //use o all()
        
        if ($request->hasFile('image') && $request->image->isValid()) {
            $imagePath = $request->image->store('products');

            $data['image'] = $imagePath;
        }
        
        Product::create($data);   //$this->repository->cretae($data)

        return redirect()->route('products.index');

        //Pegando Valores do Formulario
        //dd($request->input('name2', 'Valor de Campo Default'), $request->only(['name', 'description']),$request->has('name'), $request->name, $request->all(), $request->except(['description', '_token']));
        //input pega um valor default caso tal campo nao esteja definido
        
        //Pegando informação do Upload de arquivo
        //dd($request->file('photo'));   //Informações do arquivo, pode usar apenas $request->photo
        //dd($request->file('photo')->extension());  //Verifica a extensão do arquivo
        //dd($request->file('photo')->getClientOriginalName());  //Pega o nome original do arquivo

        if(($request->file('image')->isValid())) { //Verifica se o arquivo é valido
            //dd($request->file('image')->store('products'));   //Salva na pasta app por padrao e gera uma pasta products
            $nameFile = $request->name . '.' . $request->image->extension();
            dd($request->image->storeAs('products', $nameFile));  //Salva com um nome customizavel - Pode salvar em Public ou em Local
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
        $product = Product::where('id', $id)->first();

        return view('admin.pages.products.show', [
            'product' => $product
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::where('id', $id)->first();
        return view('admin.pages.products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {
        if(!$product = Product::find($id))
            return redirect()->back();

        $data = $request->all();

        if ($request->hasFile('image') && $request->image->isValid()) {

            if ($product->image && Storage::exists($product->image)){
                Storage::delete($product->image);
            }

            $imagePath = $request->image->store('products');
            $data['image'] = $imagePath;
        }
        
        $product->update($data);
        
        return redirect()->route('products.index')->with( 'message', 'Produto Editado'); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::where('id', $id)->first();
        if ($product->image && Storage::exists($product->image)){
            Storage::delete($product->image);
        }
        Product::destroy($id);
        return redirect()->route('products.index')->with( 'message', 'Produto Deletado');   
    }

    /**
     * Search Products
     */
    public function search(Request $request)
    {
        $filters = $request->except('_token');

        $products = $this->repository->search($request->filter);
        $produtosJSON = json_encode(ProductControllerAuto::PRODUCTS);
        $estoque = 150; 

        return view('admin.pages.products.index', [
            'produtos' => $products,
            'produtosJSON' => $produtosJSON,
            'estoque' => $estoque,
            'filters' => $filters
        ]);
    }
}
