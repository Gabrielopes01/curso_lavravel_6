<?php

namespace App\Http\Controllers;

use Hamcrest\Type\IsInteger;
use Illuminate\Http\Request;

class ProductController extends Controller
{

    private const PRODUCTS = ['Batata', 'Tomate', 'Cenoura'];

    public function index()
    {
        return ProductController::PRODUCTS;
    }

    public function show($id){
        return "Id: ".$id." - Produto: ".ProductController::PRODUCTS[$id-1];
    }

    public function create(){
        return "Form de Cadastro de Produto";
    }

    public function store(){
        return "Cadastrando o Produto";
    }

    public function edit($id){
        return "Form de edição item de Id: ".$id;
    }

    public function update($id){
        return "Atualizando para o BD o item de Id: ".$id;
    }

    public function confirmDel($id){
        return "Confirmação para saber se deleta item de Id: ".$id;
    }

    public function destroy($id){
        return "Deletando do BD o item de Id: ".$id;
    }
}
