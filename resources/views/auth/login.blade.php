<x-guest-layout>
    <div class="card shadow-sm border-0" style="border-radius: 12px;">
        <div class="card-body p-4 p-md-5">
            <h5 class="fw-bold mb-4 text-center">Welcome Back</h5>

            {{-- Session Status --}}
            @if (session('status'))
                <div class="alert alert-success border-0 shadow-sm rounded mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
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
                    <label class="form-label fw-bold text-dark">Email Address</label>
                    <input type="email" name="email" class="form-control form-control-lg bg-light" value="{{ old('email') }}" required autofocus placeholder="name@example.com">
                </div>

                <div class="mb-4">
                    <div class="d-flex justify-content-between align-items-center mb-1">
                        <label class="form-label fw-bold text-dark mb-0">Password</label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none small fw-semibold" style="color: var(--cc-primary);">Forgot password?</a>
                        @endif
                    </div>
                    <input type="password" name="password" class="form-control form-control-lg bg-light" required placeholder="Enter your password">
                </div>

                <div class="mb-4 form-check">
                    <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                    <label class="form-check-label text-muted user-select-none" for="remember_me">Remember me</label>
                </div>

                <button type="submit" class="btn btn-primary btn-lg w-100 fw-bold mb-3 shadow-sm">Log in</button>
                
                <div class="text-center">
                    <span class="text-muted">Don't have an account?</span>
                    <a href="{{ route('register') }}" class="text-decoration-none fw-bold" style="color: var(--cc-primary);">Create one</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>