@extends('admin.layouts.app')

@section('title', 'Produto {{ $id }}')

@section('content')
    <h1>Produto {{ $id }}</h1>

    <form action="{{ route('products.destroy', $id) }}" method="post">
        @method('DELETE')
        @csrf
        <button type="submit">Deletar</button>
    </form>
@endsection