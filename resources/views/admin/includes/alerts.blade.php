{{-- Comentario Blade - CTRL+K+C - Não aparece nem no HTML --}}

@if ($errors->any())
    <div class="alert alert-warning">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session('message'))
    <h1>{{session('message')}}</h1>
@endif