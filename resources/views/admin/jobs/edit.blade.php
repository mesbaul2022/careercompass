@extends('layouts.app')
@section('content')
<div class="container py-4">
    <h2 class="mb-4">Edit Job Circular</h2>
    <div class="card cc-card p-4">
        <form action="{{ route('admin.jobs.update', $job) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Job Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $job->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Company / Organization</label>
                <input type="text" name="company_name" class="form-control" value="{{ old('company_name', $job->company_name) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="BCS" @selected(old('category', $job->category) === 'BCS')>BCS</option>
                    <option value="Govt Bank" @selected(old('category', $job->category) === 'Govt Bank')>Govt Bank</option>
                    <option value="Non-Govt" @selected(old('category', $job->category) === 'Non-Govt')>Non-Govt Bank</option>
                    <option value="Engineering" @selected(old('category', $job->category) === 'Engineering')>Engineering</option>
                    <option value="NGO" @selected(old('category', $job->category) === 'NGO')>NGO</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Description</label>
                <textarea name="description" rows="5" class="form-control" required>{{ old('description', $job->description) }}</textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Application Deadline</label>
                <input type="date" name="deadline" class="form-control" value="{{ old('deadline', $job->deadline->format('Y-m-d')) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Circular Image (optional — leave blank to keep the current one)</label>
                @if ($job->image)
                    <div class="small text-muted mb-1">Current file: {{ basename($job->image) }}</div>
                @endif
                <input type="file" name="image" class="form-control">
            </div>
            <div class="mb-3">
                <label class="form-label">PDF Attachment (optional — leave blank to keep the current one)</label>
                @if ($job->attachment)
                    <div class="small text-muted mb-1">Current file: {{ basename($job->attachment) }}</div>
                @endif
                <input type="file" name="attachment" class="form-control">
            </div>
            <button class="btn btn-primary px-4">Update</button>
        </form>
    </div>
</div>
@endsection