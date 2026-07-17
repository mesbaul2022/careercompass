<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Publish New Job Circular</h2>
    </x-slot>

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
                    <option value="Non-Govt">Non-Govt</option>
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
                <input type="file" name="image" class="form-control" accept="image/*">
            </div>
            <div class="mb-3">
                <label class="form-label">PDF Attachment (optional)</label>
                <input type="file" name="attachment" class="form-control" accept="application/pdf">
            </div>
            <button class="btn btn-primary px-4">Publish</button>
        </form>
    </div>
</x-app-layout>