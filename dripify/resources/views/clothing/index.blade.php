@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Roupas</h1>

    @if($clothes->isEmpty())
        <p>Você ainda não cadastrou roupas.</p>
    @else
        <ul>
            @foreach($clothes as $clothing)
                <li>
                    <strong>{{ $clothing->clothing_name }}</strong><br>
                    <p>{{ $clothing->clothing_description }}</p>
                    <img src="{{ asset('storage/' . $clothing->clothing_path) }}" 
                         alt="Imagem da roupa" 
                         style="max-width: 200px; height: auto;">
                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
