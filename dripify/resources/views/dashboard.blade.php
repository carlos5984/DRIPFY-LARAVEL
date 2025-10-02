
<x-layout>
    @auth
        <h1>Welcome {{ Auth::user()->name }}</h1>
        <form method="post" action="{{ route('logout') }}">
            @csrf
            <button type="submit">Logout</button>
        </form>
    @endauth

</x-layout>
