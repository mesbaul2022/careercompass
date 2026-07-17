<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Edit Job Circular</h2>
    </x-slot>

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
                    <option value="BCS" @selected($job->category === 'BCS')>BCS</option>
                    <option value="Govt Bank" @selected($job->category === 'Govt Bank')>Govt Bank</option>
                    <option value="Non-Govt" @selected($job->category === 'Non-Govt')>Non-Govt</option>
                    <option value="Engineering" @selected($job->category === 'Engineering')>Engineering</option>
                    <option value="NGO" @selected($job->category === 'NGO')>NGO</option>
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
                <label class="form-label">Circular Image (optional)</label>
                <input type="file" name="image" class="form-control" accept="image/*">
                @if($job->image)
                    <small class="text-muted d-block mt-1">Current image exists. Uploading a new one will replace it.</small>
                @endif
            </div>
            <div class="mb-3">
                <label class="form-label">PDF Attachment (optional)</label>
                <input type="file" name="attachment" class="form-control" accept="application/pdf">
                @if($job->attachment)
                    <small class="text-muted d-block mt-1">Current attachment exists. Uploading a new one will replace it.</small>
                @endif
            </div>
            <button class="btn btn-primary px-4">Update</button>
        </form>
    </div>
</x-app-layout>