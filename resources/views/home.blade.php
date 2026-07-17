@extends('layouts.public')
@section('content')

<div class="cc-hero text-center mb-5">
    <h1 class="fw-bold">Never Miss a Job Circular Again</h1>
    <p class="lead mb-4">BCS, Government Banks, Engineering, NGOs — all in one organized place, updated daily.</p>
    <form action="{{ route('jobs.public.index') }}" method="GET" class="row justify-content-center g-2">
        <div class="col-md-6">
            <input type="text" name="search" class="form-control form-control-lg"
                   placeholder="Search by job title, e.g. 'Assistant Engineer'">
        </div>
        <div class="col-md-2">
            <button class="btn btn-accent btn-lg w-100">Search</button>
        </div>
    </form>
</div>

<div class="row text-center mb-5">
    @foreach (['BCS', 'Govt Bank', 'Non-Govt', 'Engineering', 'NGO'] as $cat)
        @php $slug = \Illuminate\Support\Str::slug($cat); @endphp
        <div class="col-6 col-md-2 mb-3">
            <a href="{{ route('jobs.public.index', ['category' => $cat]) }}" class="text-decoration-none">
                <div class="card cc-card p-3 h-100">
                    <img src="{{ asset('images/categories/' . $slug . '.png') }}" alt="{{ $cat }}" class="cc-category-icon mx-auto mb-2">
                    <span class="cc-tag cat-{{ $slug }}">{{ $cat }}</span>
                </div>
            </a>
        </div>
    @endforeach
</div>

<h3 class="mb-3">Latest Circulars</h3>
<div class="row">
    @foreach ($latestJobs as $job)
        <div class="col-md-4 mb-4">
            @include('jobs._card', ['job' => $job])
        </div>
    @endforeach
</div>
@endsection