<x-guest-layout>
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold mb-4 text-center">Create an Account</h5>

            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                {{-- Bootstrap Validation Errors --}}
                @if ($errors->any())
                    <div class="alert alert-danger pb-0 border-0 shadow-sm rounded">
                        <ul class="mb-3">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Full Name</label>
                    <input type="text" name="name" class="form-control form-control-lg bg-light" value="{{ old('name') }}" required autofocus placeholder="e.g. Mesbaul Islam">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-light" value="{{ old('email') }}" required placeholder="Mesbaulislam@example.com">
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold text-dark">Password</label>
                    <input type="password" name="password" class="form-control form-control-lg bg-light" required placeholder="At least 8 characters">
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-dark">Confirm Password</label>
                    <input type="password" name="password_confirmation" class="form-control form-control-lg bg-light" required placeholder="Type password again">
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mb-3 shadow-sm">Register</button>
                
                <div class="text-center">
                    <span class="text-muted">Already registered?</span>
                    <a href="{{ route('login') }}" class="text-decoration-none fw-bold" style="color: var(--cc-primary);">Log in here</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>