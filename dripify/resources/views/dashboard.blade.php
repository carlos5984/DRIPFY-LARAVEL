<x-header-footer>
    @auth
        <div class="container text-center mt-5">
            <h1 class="mb-4">Welcome, {{ Auth::user()->name }}</h1>


            <!-- Action buttons -->
            <div class="d-flex flex-column gap-3 align-items-center" style="max-width: 250px; margin:auto;">
                <a href="{{ route('clothing.create') }}" class="w-100">
                    <button type="button" class="btn btn-primary w-100">Add Clothing</button>
                </a>

                <a href="{{ route('clothing.index') }}" class="w-100">
                    <button type="button" class="btn btn-primary w-100">View Clothing</button>
                </a>

                <a href="{{ route('look.formAddLook') }}" class="w-100">
                    <button type="button" class="btn btn-primary w-100">Generate Looks</button>
                </a>

                <a href="{{ route('look.index') }}" class="w-100">
                    <button type="button" class="btn btn-primary w-100">See Looks</button>
                </a>

            </div>
        </div>
    @endauth


</x-header-footer>
