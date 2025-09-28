<x-layout>

<form method="post" action="{{ route('login.attempt') }}">
    @csrf
    @if( $errors ->any())
        <div>
            <ul>
                @foreach($errors->all() as $error)
                    <li> {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <input type="email" name="email" placeholder="Email" />
    <input type="password" name="password" placeholder="Password" />
    <button type="submit">Submit</button>
</form>
</x-layout>
