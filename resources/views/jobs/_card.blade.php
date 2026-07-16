@php $daysLeft = $job->daysLeft(); @endphp
<div class="card cc-card h-100 p-3">
    <div class="d-flex align-items-center mb-2">
        <div class="cc-avatar me-2">{{ strtoupper(substr($job->company_name, 0, 1)) }}</div>
        <span class="cc-tag cat-{{ $job->categorySlug() }}">{{ $job->category }}</span>
    </div>
    <h5 class="mb-1">{{ $job->title }}</h5>
    <p class="text-muted small mb-2">{{ $job->company_name }}</p>
    <p class="cc-deadline {{ (!$job->isExpired() && $daysLeft <= 3) ? 'urgent' : 'normal' }} mb-3">
        @if ($job->isExpired())
            Deadline passed
        @elseif ($daysLeft <= 3)
            Only {{ $daysLeft }} day(s) left!
        @else
            Apply by {{ $job->deadline->format('d M, Y') }}
        @endif
    </p>
    <a href="{{ route('jobs.public.show', $job) }}" class="btn btn-outline-primary btn-sm mt-auto">View Details</a>
</div>