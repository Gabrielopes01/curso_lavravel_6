@extends('admin.layouts.app')

@section('title')
    Gestão de Produtos
@endsection

@section('content')
    <h1>Exibindo Produtos</h1>
    <a class="btn btn-primary" href="{{ route('products.create') }}">Cadastrar</a>

    @component('admin.components.cards')
        @slot('title')
           <h1>Título do Card</h1> 
        @endslot
    
        Este é o corpo do Card
    @endcomponent

    <hr>

    @include('admin.includes.alerts')

    @auth
        <p>Bem Vindo Usuário</p>
    @else
        <p>Não está logada</p>
    @endauth
  
    <h1>Exibindo os Produtos</h1>

    <form action="{{ route('products.search') }}" method="post" class="form form-inline">
        @csrf
        <input type="text" name="filter" placeholder="Filtrar:" class="form-control" value="{{ isset($filters)?isset($filters['filter'])?$filters['filter']:'':'' }}" style="float: left; width: 15%">
        <button type="submit" class="btn btn-info">Pesquisar</button>      
    </form>

    @isset($produtos)
        @if (empty($produtos))
            Sem Produtos <!--Usado em Array-->
        @else
            <table class="table table-striped" border="1">
                <thead>
                    <tr>
                        <th width="100">Imagem</th>
                        <th>Id</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Preço</th>
                        <th width="100">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($produtos as $produto)
                    <tr>
                        <!-- Se for o ultimo elemento muda a cor do bg-->
                        @if ($produto->image)
                            <td class='@if ($loop->last) last @endif'>
                                <a href="{{ url("storage/{$produto->image}")}}" alt="{{ $produto->name }}">
                                <img src="{{ url("storage/{$produto->image}")}}" alt="{{ $produto->name }}" style="max-width: 100px"> 
                                </a> 
                            </td>
                        @else
                            <td class='@if ($loop->last) last @endif'>
                                <a href="{{ url("storage/products/default.jpg")}}" alt="{{ $produto->name }}">
                                <img src="{{ url("storage/products/default.jpg")}}" alt="{{ $produto->name }}" style="max-width: 100px"> 
                                </a> 
                            </td>
                        @endif
                        <td class='@if ($loop->last) last @endif'> {{$produto->id}} </td>
                        <td class='@if ($loop->last) last @endif'> {{$produto->name}} </td>
                        <td class='@if ($loop->last) last @endif'> {{$produto->description}} </td>
                        <td class='@if ($loop->last) last @endif'> {{$produto->price}} </td>
                        <td class='@if ($loop->last) last @endif'>
                            <a href="{{ route('products.show', $produto->id) }}">Detalhes</a>
                            <a href="{{ route('products.edit', $produto->id) }}">Editar</a>
                        </td>
                    </tr>  
                    @endforeach
                </tbody>
            </table>
 
        @endif
        {{ $produtosJSON }}
    @endisset

    @if (isset($filters)?$filters:null)
        {!! $produtos->appends($filters)->links() !!}
    @else
        {!! $produtos->links() !!}  <!--Cria os links da paginação-->
    @endif
    
    <!-- Metodo Alternativo ao de cima
    @forelse ($produtos as $produto)
        <li> {{$produto}} </li>  
    @empty
        Sem Produtos
    @endforelse
    -->

    @if ($estoque >= 100)
        <strong>- Estoque Cheio</strong>
    @elseif ($estoque <= 99 && $estoque >= 50)
        <strong>- Estoque Abastecido</strong>
    @else
        <strong>- Estoque Reduzido</strong>
    @endif


    @unless ($estoque <= 150)
        <strong>- Capacidade Excedida</strong>
    @else
        <strong>- Dentro da Capacidade</strong>
    @endunless

    @switch($estoque)
        @case(50)
            <p>Estoque pela Metade</p>
            @break
        @case(100)
            <p>Limite Aceitável do Estoque</p>
            @break
        @case(150)
            <p>Limite Máximo do Estoque</p>
            @break
        @default
            
    @endswitch

@endsection



@push('styles')
    <style>
        .last {background: #CCC}
    </style>
@endpush



@push('scripts')
    <script>
        document.body.style.background = '#999'
    </script>
@endpush