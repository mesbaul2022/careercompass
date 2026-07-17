@extends('layouts.public')
@section('content')

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="cc-filter-panel">
            <h6 class="mb-3">Filter Jobs</h6>
            <form method="GET">
                <div class="mb-3">
                    <label class="form-label small">Keyword</label>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Job title">
                </div>
                <div class="mb-3">
                    <label class="form-label small d-block">Category</label>
                    <div class="form-check">
                        <input class="form-check-input" type="radio" name="category" value="" id="cat-all" @checked(!request('category'))>
                        <label class="form-check-label small" for="cat-all">All Categories</label>
                    </div>
                    @foreach (['BCS', 'Govt Bank', 'Non-Govt', 'Engineering', 'NGO'] as $cat)
                        @php $slug = \Illuminate\Support\Str::slug($cat); @endphp
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="category" value="{{ $cat }}" id="cat-{{ $slug }}"
                                   @checked(($category ?? request('category')) === $cat)>
                            <label class="form-check-label small" for="cat-{{ $slug }}">
                                <span class="cc-tag cat-{{ $slug }}" style="font-size:0.7rem;">
                                    <img src="{{ asset('images/categories/' . $slug . '.png') }}" alt="">
                                    {{ $cat }}
                                </span>
                            </label>
                        </div>
                    @endforeach
                </div>
                <button class="btn btn-primary w-100">Apply Filters</button>
            </form>
        </div>
    </div>

    <div class="col-md-9">
        <div class="row">
            @forelse ($jobs as $job)
                <div class="col-md-4 mb-4">
                    @include('jobs._card', ['job' => $job])
                </div>
            @empty
                <p class="text-muted">No job circulars match your search.</p>
            @endforelse
        </div>
        {{ $jobs->links() }}
    </div>
</div>
@endsection