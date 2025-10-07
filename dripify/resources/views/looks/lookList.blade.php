@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Looks</h1>

        @if($looks->isEmpty())
            <p>Você ainda não gerou os looks.</p>
        @else
            <ul>
                @foreach($looks as $lookid => $clothing_paths)
                    <li>
                        <p>look </p>
                        @foreach($clothing_paths as $clothing_path)
                        <img src="{{ asset('storage/' . $clothing_path ) }}"
                             alt="Imagem da roupa"
                             style="max-width: 200px; height: auto;">
                        @endforeach

                        <form action="{{ route('look.delete',$lookid) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Deletar look</button>
                        </form>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
