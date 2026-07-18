@extends('layouts.public')
@section('title', 'Apply for ' . $job->title)

@section('content')
<div class="container py-4">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
            
            <a href="{{ route('jobs.public.show', $job) }}" class="text-decoration-none text-muted mb-3 d-inline-block">
                <i class="bi bi-arrow-left"></i> Back to Job Details
            </a>

            <div class="card shadow-sm border-0" style="border-radius: 12px; border: 1px solid #e4e8ef !important;">
                
                {{-- Application Header --}}
                <div class="card-header bg-white p-4 border-bottom">
                    <div class="d-flex align-items-center">
                        @if($job->company_logo)
                            <img src="{{ asset('storage/' . $job->company_logo) }}" alt="Logo" class="rounded shadow-sm me-3" style="width: 60px; height: 60px; object-fit: contain; border: 1px solid #e4e8ef; padding: 3px;">
                        @else
                            <div class="rounded shadow-sm me-3 d-flex justify-content-center align-items-center fw-bold text-primary" style="width: 60px; height: 60px; background-color: #f4f6f9; font-size: 1.5rem; border: 1px solid #e4e8ef;">
                                {{ strtoupper(substr($job->company_name, 0, 1)) }}
                            </div>
                        @endif
                        <div>
                            <h4 class="mb-1 fw-bold" style="color: #1a7337;">Submit Application</h4>
                            <p class="text-muted mb-0 fw-semibold">{{ $job->title }} at {{ $job->company_name }}</p>
                        </div>
                    </div>
                </div>

                {{-- Application Form --}}
                <div class="card-body p-4 p-md-5">
                    <form action="{{ route('jobs.apply.store', $job) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom">1. Personal Information</h6>
                        
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">Full Name</label>
                                <input type="text" class="form-control bg-light" value="{{ auth()->user()->name }}" readonly>
                                <small class="text-muted">Pulled from your profile</small>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Email Address</label>
                                <input type="email" class="form-control bg-light" value="{{ auth()->user()->email }}" readonly>
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Phone Number <span class="text-danger">*</span></label>
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}" placeholder="+880 1XXXXXXXXX" required>
                        </div>

                        <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom mt-5">2. Professional Background</h6>

                        <div class="row mb-4">
                            <div class="col-md-6 mb-3 mb-md-0">
                                <label class="form-label fw-semibold">Highest Education <span class="text-danger">*</span></label>
                                <select name="highest_education" class="form-select" required>
                                    <option value="" disabled selected>Select your degree...</option>
                                    <option value="HSC / Equivalent">HSC / Equivalent</option>
                                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                                    <option value="Master's Degree">Master's Degree</option>
                                    <option value="PhD / Doctorate">PhD / Doctorate</option>
                                    <option value="Diploma">Diploma</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Years of Experience <span class="text-danger">*</span></label>
                                <select name="experience_years" class="form-select" required>
                                    <option value="" disabled selected>Select experience...</option>
                                    <option value="Fresher">Fresher (0 years)</option>
                                    <option value="1-2 Years">1-2 Years</option>
                                    <option value="3-5 Years">3-5 Years</option>
                                    <option value="5-10 Years">5-10 Years</option>
                                    <option value="10+ Years">10+ Years</option>
                                </select>
                            </div>
                        </div>

                        <h6 class="fw-bold text-primary mb-3 pb-2 border-bottom mt-5">3. Application Documents</h6>

                        <div class="mb-4">
                            <label class="form-label fw-semibold">Cover Letter (Optional)</label>
                            <textarea name="cover_letter" rows="5" class="form-control" placeholder="Write a brief cover letter highlighting why you are a good fit for this role..."></textarea>
                        </div>

                        <div class="mb-5 p-4 bg-light rounded border border-dashed">
                            <label class="form-label fw-bold d-block text-center mb-2"><i class="bi bi-file-earmark-pdf fs-3 text-danger d-block mb-1"></i> Upload your CV / Resume <span class="text-danger">*</span></label>
                            <input type="file" name="cv" class="form-control form-control-lg" accept="application/pdf" required>
                            <div class="text-center text-muted small mt-2">Only PDF files are allowed (Max: 5MB).</div>
                        </div>

                        <button class="btn btn-success btn-lg w-100 fw-bold shadow-sm">Submit Application</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
</div>
@endsection