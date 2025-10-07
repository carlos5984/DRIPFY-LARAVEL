<x-header-footer>




        <div class="container mt-5">
            <h1 class="h3 mb-4 text-center">Add new Clothing Item</h1>

            <!-- Success Message -->
            @if(session('success'))
                <div class="alert alert-success text-center">
                    {{ session('success') }}
                </div>
            @endif

            <!-- General Error Message -->
            @if(session('error'))
                <div class="alert alert-danger text-center">
                    {{ session('error') }}
                </div>
            @endif


            <div class="card shadow-sm mx-auto" style="max-width: 500px;">
                <div class="card-body">
                    <form action="{{ route('clothing.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Clothing Image -->
                        <div class="mb-3">
                            <label for="clothing_path" class="form-label">Clothing picture</label>
                            <input type="file" name="clothing_path" id="clothing_path"
                                   class="form-control @error('clothing_path') is-invalid @enderror"
                                   accept="image/*" required>
                            @error('clothing_path')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <!-- Image Preview -->
                        <div class="mb-3 text-center">
                            <img id="preview" class="img-fluid rounded" style="max-height:400px;" hidden>
                        </div>

                        <!-- Submit Button -->
                        <div class="d-flex justify-content-between">
                            <a href="{{ route('dashboard') }}" class="btn btn-outline-secondary">← Return to Home</a>
                            <button type="submit" class="btn btn-primary">Add Clothe</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <script>
            const clothingInput = document.getElementById('clothing_path');
            const previewImg = document.getElementById('preview');

            clothingInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                if (!file) {
                    previewImg.hidden = true;
                    return;
                }
                previewImg.src = URL.createObjectURL(file);
                previewImg.hidden = false;
            });
        </script>


</x-header-footer>
