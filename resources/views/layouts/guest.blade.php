<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'CareerCompass') }}</title>
    
    {{-- Fonts & Bootstrap --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    
    <style>
        body { 
            background-color: var(--cc-bg); 
            font-family: 'Inter', sans-serif; 
        }
        .auth-container {
            max-width: 480px;
            width: 100%;
        }
    </style>
</head>
<body class="d-flex align-items-center justify-content-center min-vh-100 py-5">
    
    <div class="auth-container px-3">
        {{-- Brand Logo/Name --}}
        <div class="text-center mb-4">
            <a href="/" class="text-decoration-none">
                <h1 style="color: var(--cc-primary); font-family: 'Poppins', sans-serif; font-weight: 700; font-size: 2.2rem;">
                    CareerCompass
                </h1>
            </a>
            <p class="text-muted">Your Gateway to Professional Success</p>
        </div>

        {{-- Form Content Slot --}}
        {{ $slot }}
        
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>