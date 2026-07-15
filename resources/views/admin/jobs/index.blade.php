@extends('layouts.app')
@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Manage Job Circulars</h2>
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">+ New Circular</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card cc-card p-3">
        <table class="table align-middle mb-0">
            <thead>
                <tr><th>Title</th><th>Category</th><th>Deadline</th><th>Status</th><th></th></tr>
            </thead>
            <tbody>
                @foreach ($jobs as $job)
                    <tr>
                        <td>{{ $job->title }}</td>
                        <td>{{ $job->category }}</td>
                        <td>{{ $job->deadline->format('d M, Y') }}</td>
                        <td>
                            <span class="badge {{ $job->isExpired() ? 'badge-expired' : 'badge-active' }}">
                                {{ $job->isExpired() ? 'Expired' : 'Active' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.jobs.edit', $job) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.jobs.destroy', $job) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this circular?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="mt-3">{{ $jobs->links() }}</div>
</div>
@endsection