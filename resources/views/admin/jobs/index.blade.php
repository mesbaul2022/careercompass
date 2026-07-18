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
                {{-- Swapped "expired" for "pending" to match the new workflow --}}
                <h3 class="mb-1 text-warning">{{ $stats['pending'] }}</h3>
                <small class="text-muted fw-bold">Pending Approval</small>
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
                        <td>{{ $job->title }} <br> <small class="text-muted">{{ $job->company_name }}</small></td>
                        <td>{{ $job->category }}</td>
                        <td>
                            @if($job->status === 'pending')
                                <span class="badge bg-warning text-dark"><i class="bi bi-hourglass-split"></i> Pending</span>
                            @elseif($job->isExpired())
                                <span class="badge badge-expired">Expired</span>
                            @else
                                <span class="badge badge-active">Active</span>
                            @endif
                        </td>
                        <td class="text-end">
                            
                            {{-- View Applications Button --}}
                            <a href="{{ route('admin.jobs.applications', $job) }}" class="btn btn-sm btn-info text-white fw-bold me-1">
                                <i class="bi bi-people-fill"></i> Apps ({{ $job->applications()->count() }})
                            </a>

                            {{-- Admin Approve Button --}}
                            @if(auth()->user()->role === 'admin' && $job->status === 'pending')
                                <form action="{{ route('admin.jobs.approve', $job) }}" method="POST" class="d-inline">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-sm btn-success fw-bold me-1"><i class="bi bi-check-lg"></i> Approve</button>
                                </form>
                            @endif

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