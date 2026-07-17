@extends('layouts.public')
@section('title', 'Page Not Found — CareerCompass')

@section('content')
<div class="d-flex flex-column justify-content-center align-items-center text-center py-5" style="min-height: 50vh;">
    <h1 class="display-1 fw-bold text-primary mb-2">404</h1>
    <h3 class="mb-3">Oops! We lost this page.</h3>
    <p class="lead text-muted mb-4">This page seems to have wandered off — much like a job circular past its deadline.</p>
    <a href="{{ route('home') }}" class="btn btn-primary px-4 py-2">Back to Home</a>
</div>
@endsection