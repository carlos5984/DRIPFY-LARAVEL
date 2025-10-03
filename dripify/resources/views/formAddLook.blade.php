@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Generate Look</h1>

        <!-- Mostrar mensagem de sucesso -->
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <!-- Formulário -->
        <form action="{{ route('look.add') }}" method="POST">
            @csrf

            <div>
                <label for="lookPrompt">Look Prompt</label>
                <input type="text" name="lookPrompt" id="lookPrompt" required>
            </div>

            @error('lookPrompt')
            <div>{{ $message }}</div>
            @enderror

            <div>
                <button type="submit">Generate Look!</button>
            </div>
        </form>
    </div>
@endsection
