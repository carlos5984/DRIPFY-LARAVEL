@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Gerar Look</h1>

    <!-- Mostrar mensagem de sucesso -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Mostrar erros -->
    @if ($errors->any())
        <div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('look.add') }}" method="POST">
        @csrf

        <div>
            <label for="lookPrompt">Look Prompt</label>
            <input type="text" name="lookPrompt" id="lookPrompt" required>
        </div>

        <div>
            <button type="submit">Gerar Look!</button>
        </div>
    </form>

    <div style="margin-top: 10px;">
        <a href="{{ route('dashboard') }}">
            <button type="button">Voltar ao Início</button>
        </a>
    </div>
</div>
@endsection
