<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="h4 mb-0">Applicants for: <span class="text-primary">{{ $job->title }}</span></h2>
            <a href="{{ route('admin.jobs.index') }}" class="btn btn-outline-secondary btn-sm"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
        </div>
    </x-slot>

    <div class="card cc-card p-3">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Applicant Name</th>
                    <th>Contact Info</th>
                    <th>Education</th>
                    <th>Experience</th>
                    <th class="text-end">Resume / CV</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($applications as $app)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                @if($app->user->avatar)
                                    <img src="{{ asset('storage/' . $app->user->avatar) }}" class="rounded-circle me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                @else
                                    <div class="rounded-circle d-flex justify-content-center align-items-center bg-light text-primary fw-bold me-2 border" style="width: 40px; height: 40px;">
                                        {{ strtoupper(substr($app->user->name, 0, 1)) }}
                                    </div>
                                @endif
                                <span class="fw-bold">{{ $app->user->name }}</span>
                            </div>
                        </td>
                        <td>
                            <div class="small"><i class="bi bi-envelope text-muted"></i> {{ $app->user->email }}</div>
                            <div class="small"><i class="bi bi-telephone text-muted"></i> {{ $app->phone }}</div>
                        </td>
                        <td><span class="badge bg-light text-dark border">{{ $app->highest_education }}</span></td>
                        <td>{{ $app->experience_years }}</td>
                        <td class="text-end">
                            <a href="{{ asset('storage/' . $app->cv_path) }}" target="_blank" class="btn btn-sm btn-danger fw-bold">
                                <i class="bi bi-file-earmark-pdf"></i> View CV
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center py-5 text-muted">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            No applications have been submitted for this job yet.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>