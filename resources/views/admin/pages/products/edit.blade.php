@extends('admin.layouts.app')

@section('title', 'Editar Produto')

@section('content')
    <h1>Editando Produto {{ $product->name }}</h1>

    @include('admin.includes.alerts')

    <form action="{{ route('products.update', $product->id) }}" method="post" enctype="multipart/form-data">
        @method('PUT')
        @csrf
        <div class="form-group">
            <input class="form-control" type="text" name="name" placeholder="Nome:" value="{{ $product->name }}">
            <input class="form-control" type="text" name="description" placeholder="Descrição:" value="{{ $product->description }}">
            <input class="form-control" type="text" name="price" placeholder="Preço:" value="{{ $product->price }}">
            <button class="btn btn-primary" type="submit" style="float: right">Enviar</button>
            <a href="{{ route('products.index') }}" class="btn btn-secondary" style="float: right; margin-right: 3px">Voltar</a>
        </div>
    </form>
@endsection
