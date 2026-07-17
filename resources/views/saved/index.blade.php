@extends('layouts.public')
@section('content')

<h3 class="mb-4">My Saved Jobs</h3>

<div class="row">
    @forelse ($jobs as $job)
        <div class="col-md-4 mb-4">
            @include('jobs._card', ['job' => $job])
        </div>
    @empty
        <div class="col-12 text-center py-5 text-muted">
            <p>You haven't saved any jobs yet.</p>
            <a href="{{ route('jobs.public.index') }}" class="btn btn-outline-primary mt-2">Browse Jobs</a>
        </div>
    @endforelse
</div>
<div class="mt-3">
    {{ $jobs->links() }}
</div>
@endsection