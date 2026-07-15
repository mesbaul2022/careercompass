@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Publish New Job Circular</h2>
    <div class="card cc-card p-4">
        <form action="{{ route('admin.jobs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Company / Organization</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="BCS">BCS</option>
                    <option value="Govt Bank">Govt Bank</option>
                    <option value="Non-Govt">Non-Govt Bank</option>
                    <option value="Engineering">Engineering</option>
                    <option value="NGO">NGO</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Application Deadline</label>
                <input type="date" name="deadline" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Circular Image (optional)</label>
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">PDF Attachment (optional)</label>
                <input type="file" name="attachment" class="form-control">
            </div>
            <button class="btn btn-primary px-4">Publish</button>
        </form>
    </div>
</div>
@endsection