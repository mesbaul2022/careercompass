<div class="card h-100 p-3 shadow-sm" style="border-radius: 8px; border: 1px solid #c9d2e0; transition: border-color 0.2s;">
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <a href="{{ route('jobs.public.show', $job) }}" class="text-decoration-none">
                <h5 style="color: #1a7337; font-weight: 600;" class="mb-1">{{ $job->title }}</h5>
            </a>
            <p class="text-dark fw-bold mb-1" style="font-size: 0.95rem;">{{ $job->company_name }}</p>
        </div>
        
        {{-- Dynamic Company Logo --}}
        @if($job->company_logo)
            <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Logo" class="shadow-sm" style="width: 45px; height: 45px; object-fit: contain; border-radius: 4px; border: 1px solid #e4e8ef;">
        @else
            <div class="cc-avatar shadow-sm" style="width: 45px; height: 45px; font-size: 1.2rem; background-color: #f4f6f9; color: #14539a; border: 1px solid #e4e8ef;">
                {{ strtoupper(substr($job->company_name, 0, 1)) }}
            </div>
        @endif
    </div>

    {{-- Dynamic Location --}}
    <p class="text-muted mb-4" style="font-size: 0.9rem;">
        <i class="bi bi-geo-alt-fill text-secondary me-1"></i> {{ $job->location ?? 'Location Not Specified' }}
    </p>

    {{-- Dynamic Experience & Deadline --}}
    <div class="d-flex justify-content-between align-items-center mt-auto pt-2 text-muted" style="font-size: 0.85rem; border-top: 1px solid #f0f0f0;">
        <span><i class="bi bi-briefcase-fill text-secondary me-1"></i> {{ $job->experience ?? 'N/A' }}</span>
        <span class="fw-bold" style="color: #4b5563;"><i class="bi bi-calendar-event text-secondary me-1"></i> {{ $job->deadline->format('d M Y') }}</span>
    </div>
</div>