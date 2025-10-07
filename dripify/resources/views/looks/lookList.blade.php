@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Looks</h1>

        @if($looks->isEmpty())
            <p>Você ainda não gerou os looks.</p>
        @else
            <ul>
                @foreach($looks as $look)
                    <li>
                        <p>look </p>
                        @foreach($look as $clothing_path)
                        <img src="{{ asset('storage/' . $clothing_path ) }}"
                             alt="Imagem da roupa"
                             style="max-width: 200px; height: auto;">
                        @endforeach
                    </li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
