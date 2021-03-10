<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TesteController extends Controller
{
    public function teste(){
        return "Teste Controller do Admin";
    }

    public function goToView(){
        $teste = 123;
        $nome = 'Gabriel';
        $html = '<h1>Título</h1>';
        
        return view('teste', compact('teste', 'nome', 'html'));  //Compact transforma os nomes em um vetor com indice do mesmo nome e o nome da var
        /*
        //Pode passar por array
        return view('teste', [
            'teste' => $teste
        ]);
        */
    }
}
