@extends('layouts.public')
@section('content')

<div class="row">
    <div class="col-md-8">
        <div class="card cc-card p-4 mb-4">
            <div class="d-flex align-items-center mb-3">
                <div class="cc-avatar me-3">{{ strtoupper(substr($job->company_name, 0, 1)) }}</div>
                <div>
                    <span class="cc-tag cat-{{ $job->categorySlug() }} mb-1 d-inline-block">
                        <img src="{{ asset('images/categories/' . $job->categorySlug() . '.png') }}" alt="">
                        {{ $job->category }}
                    </span>
                    <h2 class="mb-0">{{ $job->title }}</h2>
                    <p class="text-muted mb-0">{{ $job->company_name }}</p>
                </div>
            </div>

            @if ($job->image)
                <img src="{{ asset('storage/' . $job->image) }}" class="img-fluid rounded mb-3" style="max-height:400px;">
            @endif

            <p style="white-space: pre-line;">{{ $job->description }}</p>

            @if ($job->attachment)
                <a href="{{ asset('storage/' . $job->attachment) }}" target="_blank" class="btn btn-outline-secondary mt-2">
                    Download Attachment (PDF)
                </a>
            @endif
        </div>

        @if ($syllabus)
            <div class="card cc-card p-4 mt-4">
                <h5>Suggested Syllabus: {{ $syllabus->title }}</h5>
                <div class="mt-2">{!! nl2br(e($syllabus->content)) !!}</div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <div class="cc-filter-panel">
            <h6 class="mb-3">Quick Facts</h6>
            <p class="mb-2">
                <strong>Status:</strong>
                <span class="badge {{ $job->isExpired() ? 'badge-expired' : 'badge-active' }}">
                    {{ $job->isExpired() ? 'Expired' : 'Active' }}
                </span>
            </p>
            <p class="mb-2"><strong>Deadline:</strong> {{ $job->deadline->format('d M, Y') }}</p>
            <p class="mb-3"><strong>Category:</strong> {{ $job->category }}</p>

            @auth
                <form action="{{ route('saved.toggle', $job) }}" method="POST">
                    @csrf
                    <button class="btn btn-primary w-100">
                        {{ auth()->user()->savedJobs->contains($job->id) ? 'Remove from Saved' : 'Save this Job' }}
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-primary w-100">Login to Save</a>
            @endauth
        </div>
    </div>
</div>

    @if ($similarJobs->isNotEmpty())
        <hr class="my-5">
        <h4 class="mb-4">Similar Jobs You Might Like</h4>
        <div class="row">
            @foreach ($similarJobs as $related)
                <div class="col-md-4 mb-4">
                    @include('jobs._card', ['job' => $related])
                </div>
            @endforeach
        </div>
    @endif
@endsection