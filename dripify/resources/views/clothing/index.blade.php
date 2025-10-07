@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Minhas Roupas</h1>

    <div style="margin-top: 20px;">
        <a href="{{ route('dashboard') }}">
            <button type="button">← Voltar ao Início</button>
        </a>
    </div>

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
                         style="max-width: 200px; height: auto;"><br>

                    <!-- Botão para alternar disponibilidade -->

                    <form action="{{ route('clothing.toggleAvailable', $clothing->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <button type="submit">
                            {{ $clothing->available ? 'Desativar' : 'Ativar' }}
                        </button>
                    </form>

                    <form action="{{ route('clothing.delete', $clothing->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit">
                            {'Deletar'}
                        </button>
                    </form>

                </li>
            @endforeach
        </ul>
    @endif
</div>
@endsection
