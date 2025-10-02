@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Add New Clothing</h1>

    <!-- Mostrar mensagem de sucesso -->
    @if(session('success'))
        <div>{{ session('success') }}</div>
    @endif

    <!-- Formulário -->
    <form action="{{ route('clothing.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div>
            <label for="clothing_path">Clothing Photo</label>
            <input type="file" name="clothing_path" id="clothing_path" required>
        </div>

        @error('clothing_path')
            <div>{{ $message }}</div>
        @enderror

        <div>
            <button type="submit">Add Clothing</button>
        </div>
    </form>
</div>
@endsection
