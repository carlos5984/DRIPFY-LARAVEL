<x-header-footer>

        <div class="container mt-5">
            <h1 class="h3 mb-4 text-center">My Wardrobe</h1>

            <!-- Back to Dashboard -->
            <div class="mb-4 text-center">
                <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Return to Home</a>
            </div>

            @if($clothes->isEmpty())
                <p class="text-center">No clothes have been added yet.</p>
            @else
                <div class="row g-4">
                    @foreach($clothes as $clothing)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm h-100">
                                <img src="{{ asset('storage/' . $clothing->clothing_path) }}"
                                     class="card-img-top"
                                     alt="huh"
                                     style="max-height:250px;{{$clothing->available ? '' : 'filter: grayscale(1);'}}">
                                <div class="card-body d-flex flex-column">
                                    <h5 class="card-title">{{ $clothing->clothing_name ?? 'huhh' }}</h5>
                                    <p class="card-text">{{ $clothing->clothing_description ?? 'Something went terribly wrong, please report this to the developers.' }}</p>

                                    <div class="mt-auto d-flex justify-content-between">
                                        <!-- Toggle Availability -->
                                        <form action="{{ route('clothing.toggleAvailable', $clothing->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-sm {{ $clothing->available ? 'btn-success' : 'btn-warning' }}">
                                                {{ $clothing->available ? 'Available' : 'Unavailable' }}
                                            </button>
                                        </form>

                                        <!-- Delete Clothing -->
                                        <form action="{{ route('clothing.delete', $clothing->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>



</x-header-footer>
