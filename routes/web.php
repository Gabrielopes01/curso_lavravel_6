<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Gupos de Rotas*/


Route::get('/login', function() {
    return "Login";
})->name('login');

//Rotas normalmente não devem ter lógica, elas devem passar tudo para o Controller
/*
Route::middleware([])->group(function() {
    Route::prefix('admin')->group(function() {
        Route::name('admin.')->group(function() {
            Route::namespace('App\Http\Controllers\Admin')->group(function() {
                Route::get('/', 'TesteController@teste')->name('home');   //Criar Controller no terminal: php artisan make:controller Admin\TesteController
            });
    
            Route::get('/dashboard', function() {
                return "Home Admin";
            })->name('dashboard');   //Um tipo de filtro de acesso que redireciona para a rota login caso não tenha permissão
            
            Route::get('/financeiro', function() {
                return "Financeiro Admin";
            })->name('financeiro');
            
            Route::get('/produtos', function() {
                return "Produtos Admin";
            })->name('produtos');
        });

    });
});
*/
//Maneira alternativa - Todos os parametros em um group
Route::group([
    'middleware' => [],
    'prefix' => 'admin',
    'namespace' => 'App\Http\Controllers\Admin'
], function() {
    Route::name('admin.')->group(function() {   //Name não funciona nos parametros
        Route::get('/', 'TesteController@teste')->name('home');   //Criar Controller no terminal: php artisan make:controller Admin\TesteController

        Route::get('/dashboard', function() {
            return "Home Admin";
        })->name('dashboard');   //Um tipo de filtro de acesso que redireciona para a rota login caso não tenha permissão
        
        Route::get('/financeiro', function() {
            return "Financeiro Admin";
        })->name('financeiro');
        
        Route::get('/produtos', function() {
            return redirect(route('admin.financeiro'));
        })->name('produtos');
    });

});



//Nomes das rotas
Route::get('/redirect3', function() {
    return redirect(route('url.name'));   //Pode usar o redirect()->route('url.name') no lugar
});

Route::get('/nome-url', function() {
    return "Ola, Rota Nomeada";
})->name('url.name');


//Views e Redirect
Route::view('/home', 'welcome');

Route::redirect('/1', '/2');

Route::get('/2', function() {
    return "Redirect em uma linha";
});

Route::get('/redirect1/{user?}', function($user = 'null'){
    if($user == 'null') {
        return redirect('/redirect2');
    }
    return "Ola ".$user;
});

Route::get('/redirect2', function() {
    return "Faça o Login";
});

//Parametros nas Rotas
Route::get('/categorias/{flag}/posts/{user?}', function($flag, $user = "null") {
    return "Posts da Categoria: ".$flag." Logado como: ".$user;
});

Route::get('/categorias/{flag}', function($flag) {
    return "Produtos da Categoria: ".$flag;
});

Route::any('/any', function() {
    return "Any - Aceita todo tipo de requisição (GET, POST, etc)";
});

Route::match(['post', 'put'], '/match', function() {
    return "Match - Recebe quando os parametros de recebimento são atendidos";
});

Route::post('/register', function() {
    return view('register');
});

Route::get('/contato', function() {
    return view('contact');
});

Route::get('/', function () {
    return view('welcome');
});
