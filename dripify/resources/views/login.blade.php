<x-layout>

    <h1 class="text-center mb-3 fst-italic fw-bold">
            webpresenca
    </h1>
    <form method="post" action="{{ route('login.attempt') }}" class="card p-4 shadow-sm mx-auto" style="max-width: 400px;">
        @csrf
        <h4 class="text-center mb-3">Login</h4>



        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input
                type="email"
                class="form-control"
                id="email"
                name="email"
                value="{{ old('email') }}"
                placeholder="Enter your email"
            >

        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input
                type="password"
                class="form-control"
                id="password"
                name="password"
                placeholder="Enter password"
            >

        </div>

        <button type="submit" class="btn btn-primary  mb-3 w-100">Login</button>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </form>




</x-layout>
