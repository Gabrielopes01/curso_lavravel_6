@extends('admin.layouts.app')

@section('title', 'Produto {{ $product->id }}')

@section('content')
    <h1>Produto {{ $product->id }} = {{ $product->name }}</h1>
    <p>Descerição = {{ $product->description }}</p>
    <h3>Valor: {{ $product->price }}</h3>

    <a href="{{ route('products.index') }}" class="btn btn-secondary" style="float: left; margin-right: 3px">Voltar</a>
    <form action="{{ route('products.destroy', $product->id) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit" class="btn btn-danger">Deletar</button>
    </form>
@endsection