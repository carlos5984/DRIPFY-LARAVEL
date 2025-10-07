<x-header-footer>

    <div class="container mt-5">
        <h1 class="h3 mb-4 text-center">Looks</h1>

        @if($looks->isEmpty())
            <p class="text-center">Você ainda não gerou os looks.</p>
        @else
            <div class="row g-4">
                @foreach($looks as $lookid => $clothing_paths)
                    <div class="col-md-6 col-lg-4">
                        <div class="card shadow-sm h-100">
                            <div class="card-body">
                                <h5 class="card-title">Look {{ $loop->remaining + 1 }}</h5>
                                <div class="mb-3 d-flex flex-wrap gap-2">
                                    @foreach($clothing_paths as $clothing_path)
                                        <img src="{{ asset('storage/' . $clothing_path) }}"
                                             alt="Roupa do look"
                                             class="img-fluid rounded"
                                             style="max-height:240px; object-fit:cover;">
                                    @endforeach
                                </div>

                                <form action="{{ route('look.delete', $lookid) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger w-100">
                                        Deletar Look
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        <div class="mt-4 text-center">
            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Voltar ao Início</a>
        </div>
    </div>

</x-header-footer>
