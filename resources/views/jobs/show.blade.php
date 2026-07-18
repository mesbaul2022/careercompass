@extends('layouts.public')
@section('title', $job->title . ' - CareerCompass')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm border mb-5">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-start mb-4 pb-3 border-bottom">
        <div class="d-flex align-items-center">
            
            {{-- Dynamic Company Logo --}}
            @if($job->company_logo)
                <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Logo" class="shadow-sm me-4" style="width: 80px; height: 80px; object-fit: contain; border-radius: 8px; border: 1px solid #e4e8ef; background-color: #fff; padding: 5px;">
            @else
                <div class="shadow-sm me-4 d-flex justify-content-center align-items-center fw-bold" style="width: 80px; height: 80px; font-size: 2rem; background-color: #f4f6f9; color: #14539a; border: 1px solid #e4e8ef; border-radius: 8px;">
                    {{ strtoupper(substr($job->company_name, 0, 1)) }}
                </div>
            @endif
            
            <div>
                <h3 style="color: #1a7337; font-weight: 700;" class="mb-1">{{ $job->title }}</h3>
                <h5 class="text-dark fw-semibold mb-1">{{ $job->company_name }} <span class="badge bg-light text-danger border ms-2" style="font-size: 0.75rem;">Insight <i class="bi bi-box-arrow-up-right"></i></span></h5>
                <p class="fw-bold mt-1 mb-0" style="color: #b3261e;"><i class="bi bi-calendar-event me-1"></i> Application Deadline : {{ $job->deadline->format('d M Y') }}</p>
            </div>
        </div>
        
        <div class="d-flex gap-2 mt-2">
            <button class="btn btn-success px-4 fw-bold">Apply Now</button>
            @auth
                <form action="{{ route('saved.toggle', $job) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-secondary fw-bold">
                        <i class="bi {{ auth()->user()->savedJobs->contains($job->id) ? 'bi-star-fill text-warning' : 'bi-star' }}"></i> Save
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary fw-bold"><i class="bi bi-star"></i> Save</a>
            @endauth
            <button class="btn btn-outline-secondary"><i class="bi bi-share"></i> Share</button>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <ul class="nav nav-tabs nav-fill mb-4" id="jobTabs" role="tablist" style="background-color: #f8f9fa; font-weight: 600;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-0 text-primary border-bottom-0" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" style="background-color: #e2e8f0;">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="req-tab" data-bs-toggle="tab" data-bs-target="#req" type="button">Requirements</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="resp-tab" data-bs-toggle="tab" data-bs-target="#resp" type="button">Responsibilities</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary" type="button">Salary & Benefits</button>
        </li>
    </ul>

    {{-- Dynamic Quick Facts Box --}}
    <div class="bg-light p-3 rounded mb-4 border">
        <div class="row text-dark" style="font-size: 0.95rem;">
            <div class="col-md-4">
                <p class="mb-1">Vacancy: <strong>Not Specified</strong></p>
                <p class="mb-0">Experience: <strong>{{ $job->experience ?? 'N/A' }}</strong></p>
            </div>
            <div class="col-md-4">
                <p class="mb-1">Location: <strong>{{ $job->location ?? 'N/A' }}</strong></p>
                <p class="mb-0">Published: <strong>{{ $job->created_at->format('d M Y') }}</strong></p>
            </div>
            <div class="col-md-4">
                <p class="mb-0">Salary: <strong>{{ $job->salary ?? 'Negotiable' }}</strong></p>
            </div>
        </div>
    </div>

    {{-- Dynamic Tab Content --}}
    <div class="tab-content" id="jobTabsContent">
        
        {{-- ALL TAB --}}
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            
            @if($job->description)
                <h5 style="color: #a81c51;" class="fw-bold mb-3">Context / General Description</h5>
                <div class="text-muted mb-4">{!! nl2br(e($job->description)) !!}</div>
            @endif

            @if($job->requirements)
                <h5 style="color: #a81c51;" class="fw-bold mb-3">Requirements</h5>
                <div class="text-muted mb-4">{!! nl2br(e($job->requirements)) !!}</div>
            @endif

            @if($job->responsibilities)
                <h5 style="color: #a81c51;" class="fw-bold mb-3">Responsibilities</h5>
                <div class="text-muted mb-4">{!! nl2br(e($job->responsibilities)) !!}</div>
            @endif

            @if($job->benefits)
                <h5 style="color: #a81c51;" class="fw-bold mb-3">Compensation & Other Benefits</h5>
                <div class="text-muted mb-4">{!! nl2br(e($job->benefits)) !!}</div>
            @endif
            
            @if ($job->image)
                <div class="mt-4">
                    <img src="{{ asset('storage/' . $job->image) }}" class="img-fluid rounded border" style="max-height:600px;">
                </div>
            @endif

            @if ($job->attachment)
                <div class="mt-4">
                    <a href="{{ asset('storage/' . $job->attachment) }}" target="_blank" class="btn btn-outline-danger">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Download Official Circular PDF
                    </a>
                </div>
            @endif
        </div>

        {{-- Individual Filtered Tabs --}}
        <div class="tab-pane fade" id="req" role="tabpanel">
            <div class="text-muted mt-3">
                {!! $job->requirements ? nl2br(e($job->requirements)) : '<em>No specific requirements listed.</em>' !!}
            </div>
        </div>
        
        <div class="tab-pane fade" id="resp" role="tabpanel">
            <div class="text-muted mt-3">
                {!! $job->responsibilities ? nl2br(e($job->responsibilities)) : '<em>No specific responsibilities listed.</em>' !!}
            </div>
        </div>
        
        <div class="tab-pane fade" id="salary" role="tabpanel">
            <div class="text-muted mt-3">
                {!! $job->benefits ? nl2br(e($job->benefits)) : '<em>No specific compensation details listed.</em>' !!}
            </div>
        </div>

    </div>
    
    {{-- Dynamic Syllabus Suggestion --}}
    @if ($syllabus)
        <hr class="my-5">
        <div class="card p-4 bg-light border-0 shadow-sm">
            <h5 class="text-primary"><i class="bi bi-book"></i> Suggested Syllabus: {{ $syllabus->title }}</h5>
            <div class="mt-2 text-muted">{!! nl2br(e($syllabus->content)) !!}</div>
        </div>
    @endif
</div>
@endsection