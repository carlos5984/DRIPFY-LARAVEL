<x-header-footer>

    <div class="container mt-5" style="max-width: 600px;">
        <h1 class="h3 mb-4 text-center">Look Generation</h1>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        <!-- Error Messages -->
        @if(session('error'))
            <div class="alert alert-danger text-center">
                {{ session('error') }}
            </div>
        @endif

        <!-- Generate Look Form -->
        <div class="card shadow-sm">
            <div class="card-body">
                <form action="{{ route('look.add') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="lookPrompt" class="form-label">Look Prompt</label>
                        <input type="text" name="lookPrompt" id="lookPrompt"
                               class="form-control @error('lookPrompt') is-invalid @enderror"
                               placeholder="Ex: Casual summer outfit"
                               required>
                        @error('lookPrompt')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Return to Home</a>
                        <button type="submit" class="btn btn-primary">Generate Look!</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

</x-header-footer>
