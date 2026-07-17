<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Manage Job Circulars</h2>
    </x-slot>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.jobs.create') }}" class="btn btn-primary">+ New Circular</a>
    </div>

    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card cc-card p-3 text-center">
                <h3 class="mb-1 text-primary">{{ $stats['total'] }}</h3>
                <small class="text-muted fw-bold">Total Circulars</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cc-card p-3 text-center">
                <h3 class="mb-1 text-success">{{ $stats['active'] }}</h3>
                <small class="text-muted fw-bold">Active</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cc-card p-3 text-center">
                <h3 class="mb-1 text-danger">{{ $stats['expired'] }}</h3>
                <small class="text-muted fw-bold">Expired</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card cc-card p-3 text-center">
                <h3 class="mb-1 text-info">{{ $stats['users'] }}</h3>
                <small class="text-muted fw-bold">Registered Users</small>
            </div>
        </div>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card cc-card p-3">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Category</th>
                    <th>Deadline</th>
                    <th>Status</th>
                    <th></th>
                </tr>
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
</x-app-layout>