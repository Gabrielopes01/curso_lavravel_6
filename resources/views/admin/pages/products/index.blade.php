@extends('admin.layouts.app')

@section('title')
    Gestão de Produtos
@endsection

@section('content')
    <h1>Exibindo Produtos</h1>
    <a href="{{ route('products.create') }}">Cadastrar</a>

    @component('admin.components.cards')
        @slot('title')
           <h1>Título do Card</h1> 
        @endslot
    
        Este é o corpo do Card
    @endcomponent

    <hr>

    @include('admin.includes.alerts', ['content' => 'Teste de Erro'])

    @auth
        <p>Bem Vindo Usuário</p>
    @else
        <p>Não está logada</p>
    @endauth
  
    <h1>Exibindo os Produtos</h1>

    @isset($produtos)
        @if (empty($produtos))
            Sem Produtos <!--Usado em Array-->
        @else
            <ul>
             @foreach ($produtos as $produto)
               <li class='@if ($loop->last) last @endif'> {{$produto}} </li>  <!-- Se for o ultimo elemento muda a cor do bg-->
             @endforeach
            </ul>   
        @endif
        {{ $produtosJSON }}
    @endisset

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