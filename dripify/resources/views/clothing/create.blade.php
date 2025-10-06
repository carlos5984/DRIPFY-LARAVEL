@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="h3 mb-4">Adicionar Nova Roupa</h1>

    <!-- Mensagem de sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Mensagem de erro geral -->
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Erro!</strong> Verifique os campos abaixo.
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="{{ route('clothing.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="clothing_path" class="form-label">Foto da Roupa</label>
                    <input type="file" name="clothing_path" id="clothing_path" 
                           class="form-control @error('clothing_path') is-invalid @enderror" 
                           accept="image/*" required>
                    @error('clothing_path')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        Adicionar Roupa
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="d-flex justify-content-center mt-4">
        <a href="{{ route('dashboard') }}" class="btn btn-secondary">
            ← Voltar ao Início
        </a>
    </div>
</div>
@endsection
