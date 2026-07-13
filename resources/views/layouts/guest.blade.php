<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'CareerCompass') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&family=Poppins:wght@600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/theme.css') }}" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body style="background-color: var(--cc-bg);">
    <div class="d-flex flex-column align-items-center justify-content-center min-vh-100 py-4">
        <a href="/" class="mb-4" style="font-family:'Poppins',sans-serif; font-weight:700; font-size:1.8rem; color:var(--cc-primary); text-decoration:none;">
            CareerCompass
        </a>
        <div class="card cc-card p-4" style="width:100%; max-width:420px;">
            {{ $slot }}
        </div>
    </div>
</body>
</html>