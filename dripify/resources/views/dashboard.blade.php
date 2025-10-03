<x-layout>
    @auth
        <div style="text-align:center; margin-top:50px;">
            <h1>Welcome, {{ Auth::user()->name }}</h1>

            <!-- Logout -->
            <form method="POST" action="{{ route('logout') }}" style="margin-bottom:20px;">
                @csrf
                <button type="submit">Logout</button>
            </form>

            <!-- Botões de ações -->
            <div style="display:flex; flex-direction:column; gap:10px; max-width:200px; margin:auto;">
                <a href="{{ route('clothing.create') }}">
                    <button type="button">Add Clothing</button>
                </a>

                <a href="{{ route('clothing.index') }}">
                    <button type="button">View Clothing</button>
                </a>

                </a>
            </div>
        </div>
    @else
        <p>Please <a href="{{ route('login') }}">login</a> to access the dashboard.</p>
    @endauth
</x-layout>
