@extends('admin.layouts.app')

@section('title', 'Cadastrar Novo Produto')

@section('content')
    <h1>Cadastrar Novo Produto</h1>

    @include('admin.includes.alerts')

    <form action="{{ route('products.store') }}" method="post" enctype="multipart/form-data">
        
        @csrf
        <div class="form-group">
            <input type="text" class="form-control" name="name" placeholder="Nome:" value="{{ old('name') }}">
            <input type="text" class="form-control" name="description" placeholder="Descrição:" value="{{ old('description') }}">  <!--O Old permite recuperar um valor inserido após recarregar a pagina-->
            <input type="text" class="form-control" name="price" placeholder="Preço:" value="{{ old('price') }}">
            <br>
            <input type="file" class="form-control" name="image">
            <button type="submit" class="btn btn-success">Enviar</button>
        </div>

    </form>
@endsection
