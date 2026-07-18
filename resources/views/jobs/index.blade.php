@extends('layouts.public')
@section('title', 'Browse Jobs - CareerCompass')

@section('content')
{{-- Custom scoped styles to override Bootstrap's default blue accordion behavior --}}
<style>
    .cc-filter-accordion .accordion-button:not(.collapsed) {
        color: #333;
        background-color: #fff;
        box-shadow: none;
    }
    .cc-filter-accordion .accordion-button:focus {
        box-shadow: none;
    }
    .cc-filter-accordion .accordion-item {
        border: none;
        border-bottom: 1px solid #e4e8ef;
    }
    .cc-filter-accordion .accordion-item:last-child {
        border-bottom: none;
    }
</style>

<div class="row">
    {{-- FILTER SIDEBAR --}}
    <div class="col-md-3 mb-4">
        <form method="GET" action="{{ route('jobs.public.index') }}">
            <div class="card shadow-sm border-0" style="border-radius: 8px; border: 1px solid #e4e8ef !important;">
                
                {{-- Search Bar (Keyword) --}}
                <div class="p-3 border-bottom">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0 text-muted">
                            <i class="bi bi-search"></i>
                        </span>
                        <input type="text" name="search" value="{{ request('search') }}" class="form-control border-start-0 ps-0" placeholder="Search for Jobs..." style="box-shadow: none;">
                    </div>
                </div>

                {{-- Accordion Filters --}}
                <div class="accordion accordion-flush cc-filter-accordion" id="filterAccordion">
                    
                    {{-- Category Filter --}}
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingCategory">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseCategory" aria-expanded="true" aria-controls="collapseCategory" style="font-weight: 600;">
                                <i class="bi bi-grid-1x2 text-primary me-2"></i> Category/Industry
                            </button>
                        </h2>
                        <div id="collapseCategory" class="accordion-collapse collapse show" aria-labelledby="headingCategory">
                            <div class="accordion-body pt-2 pb-3">
                                
                                <div class="form-check mb-3">
                                    <input class="form-check-input" type="radio" name="category" value="" id="cat-all" @checked(!request('category'))>
                                    <label class="form-check-label text-muted ms-1" for="cat-all" style="font-size: 0.9rem;">All Categories</label>
                                </div>
                                
                                @foreach (['BCS', 'Govt Bank', 'Non-Govt', 'Engineering', 'NGO'] as $cat)
                                    @php $slug = \Illuminate\Support\Str::slug($cat); @endphp
                                    <div class="form-check mb-3 d-flex align-items-center">
                                        <input class="form-check-input" type="radio" name="category" value="{{ $cat }}" id="cat-{{ $slug }}"
                                               @checked((isset($category) ? $category : request('category')) === $cat)>
                                        <label class="form-check-label ms-2 d-flex align-items-center w-100" for="cat-{{ $slug }}" style="cursor: pointer;">
                                            <span class="cc-tag cat-{{ $slug }} px-3 py-1 shadow-sm w-100 text-center" style="font-size: 0.8rem;">{{ $cat }}</span>
                                        </label>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                    </div>
                    
                </div>

                {{-- Action Buttons --}}
                <div class="p-3 bg-light border-top rounded-bottom d-flex flex-column gap-2">
                    <button type="submit" class="btn btn-primary w-100 fw-bold">Apply Filters</button>
                    <a href="{{ route('jobs.public.index') }}" class="btn btn-outline-secondary w-100 fw-bold d-flex justify-content-center align-items-center">
                        Clear All <i class="bi bi-x fs-5 ms-1"></i>
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- JOB GRID MAIN CONTENT --}}
    <div class="col-md-9">
        
        {{-- Active Filters Display Banner --}}
        @if(request('category') || request('search'))
            <div class="d-flex align-items-center mb-4 p-2 rounded shadow-sm" style="background-color: #fff; border: 1px solid #e4e8ef;">
                <span class="text-muted mx-2 fw-bold" style="font-size: 0.9rem;">Active Filter:</span>
                
                @if(request('search'))
                    <span class="badge bg-light text-primary border border-primary px-3 py-2 me-2 d-flex align-items-center" style="font-size: 0.85rem;">
                        <i class="bi bi-search me-2"></i> "{{ request('search') }}"
                    </span>
                @endif

                @if(request('category'))
                    <span class="badge bg-primary text-white px-3 py-2 me-2 d-flex align-items-center shadow-sm" style="font-size: 0.85rem;">
                        <i class="bi bi-tags-fill me-2"></i> {{ request('category') }}
                    </span>
                @endif

                <a href="{{ route('jobs.public.index') }}" class="text-secondary text-decoration-none ms-auto me-3 fw-bold" style="font-size: 0.85rem;">
                    Clear All
                </a>
            </div>
        @endif

        {{-- Grid of Job Cards --}}
        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-4 mb-4">
                    @include('jobs._card', ['job' => $job])
                </div>
            @empty
                <div class="col-12 text-center py-5 bg-white rounded shadow-sm border">
                    <h4 class="text-muted fw-bold">No job circulars match your search.</h4>
                    <p class="text-muted">Try adjusting your keyword or category filters.</p>
                    <a href="{{ route('jobs.public.index') }}" class="btn btn-outline-primary mt-3 px-4 fw-bold">Clear All Filters</a>
                </div>
            @endforelse
        </div>
        
        {{-- Pagination --}}
        <div class="mt-2 mb-5">
            {{ $jobs->links() }}
        </div>
    </div>
</div>
@endsection