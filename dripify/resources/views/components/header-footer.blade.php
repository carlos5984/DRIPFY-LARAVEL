<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Minha Aplicação' }}</title>

    <!-- App CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Bootstrap CSS -->
    <link
        href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
        rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65"
        crossorigin="anonymous"
    >
</head>
<body class="d-flex flex-column min-vh-100">

<!-- ===== HEADER ===== -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <!-- Logo top-left -->
        <a class="navbar-brand fw-bold fst-italic d-flex align-items-center" href="#">
            <span class="text-primary">DRIPI</span><span class="text-danger">FY</span>
        </a>

        <!-- Mobile toggle -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Menu links -->
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="padding:0; border:none;">
                        Logout
                    </button>
                </form>
            </ul>
        </div>
    </div>
</nav>

<!-- ===== PAGE CONTENT ===== -->
<main class="container flex-grow-1">
    {{ $slot }}
</main>

<!-- ===== FOOTER ===== -->
<footer class="bg-dark text-light text-center py-3 mt-auto">
    <div class="container">
        <small>&copy; {{ date('Y') }} DRIPIFY. All rights reserved.</small>
    </div>
</footer>

<!-- Bootstrap JS -->
<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4"
    crossorigin="anonymous">
</script>
</body>
</html>
