<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'CareerCompass — Your Daily Job Circular Hub')</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark" style="background-color: var(--cc-primary);">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">CareerCompass</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#nav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="nav">
                <div class="navbar-nav ms-auto align-items-center">
                    <a class="nav-link" href="{{ route('jobs.public.index') }}">Jobs</a>
                    @if (Route::has('materials.public.index'))
                        <a class="nav-link" href="{{ route('materials.public.index') }}">Study Materials</a>
                    @endif
                    
                    @auth
                        @if (Route::has('saved.index'))
                            <a class="nav-link" href="{{ route('saved.index') }}">Saved Jobs</a>
                        @endif
                        
                        {{-- User Dropdown with Avatar --}}
                        <div class="nav-item dropdown ms-2">
                            <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                @if(auth()->user()->avatar)
                                    <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 32px; height: 32px; object-fit: cover; border: 2px solid #fff;">
                                @else
                                    <div class="rounded-circle d-flex justify-content-center align-items-center fw-bold" style="width: 32px; height: 32px; background-color: #fff; color: var(--cc-primary); font-size: 0.9rem;">
                                        {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="fw-bold text-white">{{ auth()->user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item py-2" href="{{ route('dashboard') }}"><i class="bi bi-speedometer2 me-2 text-secondary"></i> Dashboard</a></li>
                                <li><a class="dropdown-item py-2" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2 text-secondary"></i> My Profile</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item py-2 text-danger fw-bold"><i class="bi bi-box-arrow-right me-2"></i> Log Out</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">Login</a>
                        <a class="nav-link btn btn-light text-primary px-4 ms-2 fw-bold" href="{{ route('register') }}" style="border-radius: 50px;">Register</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <main class="container my-4">
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="alert alert-danger">{{ session('error') }}</div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="text-center text-muted py-4 mt-5 border-top">
        &copy; {{ date('Y') }} CareerCompass — Built to help job seekers stay ahead.
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>