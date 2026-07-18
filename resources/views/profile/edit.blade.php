@extends('layouts.public')
@section('title', 'My Profile - CareerCompass')

@section('content')
<div class="container py-4">
    <h3 class="mb-4" style="color: #1a7337; font-weight: 700;">My Profile Settings</h3>

    @if (session('status') === 'profile-updated')
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> Profile updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    
    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show shadow-sm" role="alert">
            <i class="bi bi-check-circle-fill me-2"></i> Password updated successfully.
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        {{-- Profile Information Card --}}
        <div class="col-md-7 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 8px; border: 1px solid #e4e8ef !important;">
                <div class="card-header bg-white pt-4 pb-2 border-bottom-0">
                    <h5 class="fw-bold mb-0">Profile Information</h5>
                    <p class="text-muted small mb-0">Update your account's profile information and avatar.</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('patch')

                        <div class="mb-4 d-flex align-items-center gap-3 p-3 bg-light rounded border">
                            @if(auth()->user()->avatar)
                                <img src="{{ asset('storage/' . auth()->user()->avatar) }}" alt="Avatar" class="rounded-circle shadow-sm border" style="width: 75px; height: 75px; object-fit: cover;">
                            @else
                                <div class="rounded-circle shadow-sm d-flex justify-content-center align-items-center fw-bold fs-3" style="width: 75px; height: 75px; background-color: #14539a; color: white;">
                                    {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                                </div>
                            @endif
                            <div class="w-100">
                                <label class="form-label fw-bold mb-1" style="font-size: 0.9rem;">Profile Picture</label>
                                <input type="file" name="avatar" class="form-control form-control-sm" accept="image/*">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">Full Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name', $user->name) }}" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Email Address</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email', $user->email) }}" required>
                        </div>

                        <button type="submit" class="btn btn-primary px-4 fw-bold w-100">Save Profile Changes</button>
                    </form>
                </div>
            </div>
        </div>

        {{-- Update Password Card --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0" style="border-radius: 8px; border: 1px solid #e4e8ef !important;">
                <div class="card-header bg-white pt-4 pb-2 border-bottom-0">
                    <h5 class="fw-bold mb-0">Update Password</h5>
                    <p class="text-muted small mb-0">Ensure your account is using a long, random password.</p>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('password.update') }}">
                        @csrf
                        @method('put')

                        <div class="mb-3">
                            <label class="form-label fw-bold">Current Password</label>
                            <input type="password" name="current_password" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-bold">New Password</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label fw-bold">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-dark px-4 fw-bold w-100">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection