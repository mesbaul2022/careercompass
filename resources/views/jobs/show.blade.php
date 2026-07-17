@extends('layouts.public')
@section('title', $job->title . ' - CareerCompass')

@section('content')
<div class="container bg-white p-4 rounded shadow-sm border mb-5">
    
    {{-- Header Section --}}
    <div class="d-flex justify-content-between align-items-start mb-3">
        <div>
            <h3 style="color: #1a7337; font-weight: 600;">{{ $job->title }}</h3>
            <h5 class="text-dark">{{ $job->company_name }} <span class="badge bg-light text-danger border ms-2" style="font-size: 0.7rem;">Insight <i class="bi bi-box-arrow-up-right"></i></span></h5>
            <p class="fw-bold mt-2" style="color: #b3261e;">Application Deadline : {{ $job->deadline->format('d M Y') }}</p>
        </div>
        
        <div class="d-flex gap-2">
            <button class="btn btn-success px-4 fw-bold">Apply Now</button>
            @auth
                <form action="{{ route('saved.toggle', $job) }}" method="POST" class="d-inline">
                    @csrf
                    <button class="btn btn-outline-secondary fw-bold">
                        <i class="bi {{ auth()->user()->savedJobs->contains($job->id) ? 'bi-star-fill text-warning' : 'bi-star' }}"></i> Save
                    </button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn btn-outline-secondary fw-bold"><i class="bi bi-star"></i> Save</a>
            @endauth
            <button class="btn btn-outline-secondary"><i class="bi bi-share"></i> Share</button>
            <button class="btn btn-outline-secondary"><i class="bi bi-printer"></i></button>
        </div>
    </div>

    {{-- Tabs Navigation --}}
    <ul class="nav nav-tabs nav-fill mb-4" id="jobTabs" role="tablist" style="background-color: #f8f9fa; font-weight: 600;">
        <li class="nav-item" role="presentation">
            <button class="nav-link active rounded-0 text-primary border-bottom-0" id="all-tab" data-bs-toggle="tab" data-bs-target="#all" type="button" style="background-color: #e2e8f0;">All</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="req-tab" data-bs-toggle="tab" data-bs-target="#req" type="button">Requirements</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="resp-tab" data-bs-toggle="tab" data-bs-target="#resp" type="button">Responsibilities</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link rounded-0 text-muted" id="salary-tab" data-bs-toggle="tab" data-bs-target="#salary" type="button">Salary & Benefits</button>
        </li>
    </ul>

    {{-- Quick Facts Box --}}
    <div class="bg-light p-3 rounded mb-4 border">
        <div class="row text-dark" style="font-size: 0.95rem;">
            <div class="col-md-4">
                <p class="mb-1">Vacancy: <strong>--</strong></p>
                <p class="mb-0">Experience: <strong>At most 2 years</strong></p>
            </div>
            <div class="col-md-4">
                <p class="mb-1">Location: <strong>Dhaka (Banasree)</strong></p>
                <p class="mb-0">Published: <strong>{{ $job->created_at->format('d M Y') }}</strong></p>
            </div>
            <div class="col-md-4">
                <p class="mb-0">Salary: <strong>Negotiable</strong></p>
            </div>
        </div>
    </div>

    <div class="alert alert-info border-info py-2 mb-4">
        Applicants are encouraged to submit <strong>Video CV</strong>.
    </div>

    {{-- Tab Content --}}
    <div class="tab-content" id="jobTabsContent">
        
        {{-- ALL TAB }}
        <div class="tab-pane fade show active" id="all" role="tabpanel">
            
            {{-- Requirements Section --}}
            <h5 style="color: #a81c51;" class="fw-bold mb-3">Requirements</h5>
            <h6 class="fw-bold">Education</h6>
            <ul class="text-muted">
                <li>BBA / MBA in Accounting, Finance, or a related discipline from a recognized university.</li>
            </ul>

            <h6 class="fw-bold mt-3">Experience</h6>
            <ul class="text-muted">
                <li>At most 2 years</li>
                <li>The applicants should have experience in the following business area(s): Chamber, Clinic, Hospital, Physiotherapy center</li>
                <li>Freshers are also encouraged to apply.</li>
            </ul>

            <h6 class="fw-bold mt-3">Additional Requirements</h6>
            <ul class="text-muted">
                <li>Candidates residing in Banasree, Rampura, Aftabnagar, Meradia, Khilgaon, Basabo, Shahjahanpur, Malibagh, or nearby areas will be given preference.</li>
                <li>Strong understanding of accounting principles and financial reporting.</li>
                <li>Knowledge of VAT, Tax, and Bangladesh Financial Regulations.</li>
                <li>Proficiency in Microsoft Excel, Word, and accounting software (Tally, ERP, or similar systems).</li>
                <li>Ability to work under pressure and meet deadlines.</li>
                <li>High level of integrity, professionalism, and confidentiality.</li>
            </ul>

            {{-- Responsibilities Section --}}
            <h5 style="color: #a81c51;" class="fw-bold mt-5 mb-3">Responsibilities & Context</h5>
            <p class="text-muted mb-4">
                Farazy Dental & Research Ltd. is one of Bangladesh's leading dental healthcare organizations, committed to delivering quality dental services through modern technology and professional excellence. We are currently seeking a motivated, detail-oriented, and dynamic Accounts & Finance Executive...
            </p>

            <h6 class="fw-bold">Job Responsibilities</h6>
            <ul class="text-muted">
                <li>Prepare monthly financial reports, including Income Statement, Profit & Loss Analysis, Trial Balance.</li>
                <li>Assist in preparing financial statements, including Balance Sheet, Income Statement, and Cash Flow Statement.</li>
                <li>Prepare monthly payroll and salary sheets.</li>
                <li>Monitor bill and voucher preparation and ensure timely posting into the accounting system.</li>
                <li>Reconcile bank statements and monitor daily financial transactions.</li>
                <li>Support internal and external audit activities by providing necessary financial information and documentation.</li>
            </ul>
            <p class="fw-bold text-dark mt-3">Workplace: Farazy Dental & Research Ltd. (Head office), Banasree, Rampura, Dhaka</p>

            {{-- Compensation Section --}}
            <h5 style="color: #a81c51;" class="fw-bold mt-5 mb-3">Compensation & Other Benefits</h5>
            <ul class="text-muted">
                <li>Salary: Negotiable (Based on qualifications and experience)</li>
                <li>Performance-based annual increment</li>
                <li>Festival Bonus</li>
                <li>Mobile Allowance (As per company policy)</li>
            </ul>
            
        </div>


        <div class="tab-pane fade" id="req" role="tabpanel">
            <p class="text-muted mt-3"><em>Clicking this tab will filter to show only Requirements...</em></p>
        </div>
        <div class="tab-pane fade" id="resp" role="tabpanel">
            <p class="text-muted mt-3"><em>Clicking this tab will filter to show only Responsibilities...</em></p>
        </div>
        <div class="tab-pane fade" id="salary" role="tabpanel">
            <p class="text-muted mt-3"><em>Clicking this tab will filter to show only Salary & Benefits...</em></p>
        </div>

    </div>
    
    {{-- Dynamic Syllabus Suggestion --}}
    @if ($syllabus)
        <hr class="my-5">
        <div class="card p-4 bg-light border-0 shadow-sm">
            <h5 class="text-primary"><i class="bi bi-book"></i> Suggested Syllabus: {{ $syllabus->title }}</h5>
            <div class="mt-2 text-muted">{!! nl2br(e($syllabus->content)) !!}</div>
        </div>
    @endif
</div>
@endsection