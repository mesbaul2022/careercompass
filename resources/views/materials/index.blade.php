@extends('layouts.public')
@section('content')

<div class="row">
    <div class="col-md-3 mb-4">
        <div class="cc-filter-panel">
            <h6 class="mb-3">Filter Materials</h6>
            <form method="GET">
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
                                   @checked(request('category') === $cat)>
                            <label class="form-check-label small" for="cat-{{ $slug }}">
                                <span class="cc-tag cat-{{ $slug }}" style="font-size:0.7rem;">{{ $cat }}</span>
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
            @forelse ($materials as $material)
                <div class="col-md-4 mb-4">
                    <div class="card cc-card h-100 p-3 text-center">
                        <span class="cc-tag cat-{{ \Illuminate\Support\Str::slug($material->category) }} mb-2 mx-auto d-inline-block">{{ $material->category }}</span>
                        <h6 class="mb-3">{{ $material->title }}</h6>
                        <a href="{{ asset('storage/' . $material->file_path) }}" target="_blank" class="btn btn-outline-primary btn-sm mt-auto">
                            Download PDF
                        </a>
                    </div>
                </div>
            @empty
                <p class="text-muted">No study materials found for this category.</p>
            @endforelse
        </div>
        {{ $materials->links() }}
    </div>
</div>
@endsection