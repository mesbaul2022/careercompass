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
                <label class="form-label">Company / Organization Name</label>
                <input type="text" name="company_name" class="form-control" required>
            </div>
            
            {{-- NEW: Company Logo --}}
            <div class="mb-3">
                <label class="form-label">Company Logo (optional)</label>
                <input type="file" name="company_logo" class="form-control" accept="image/*">
            </div>

            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="BCS">BCS</option>
                    <option value="Bank">Bank</option>
                    <option value="Non-Govt">Non-Govt</option>
                    <option value="Engineering">Engineering</option>
                    <option value="NGO">NGO</option>
                    <option value="Government">Government</option>
                    <option value="Healthcare">Healthcare</option>
                    <option value="Telecom">Telecom</option>
                </select>
            </div>

            {{-- NEW: Quick Facts Row --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label class="form-label">Location</label>
                    <input type="text" name="location" class="form-control" placeholder="e.g. Dhaka (Banasree)">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Experience</label>
                    <input type="text" name="experience" class="form-control" placeholder="e.g. At most 2 years">
                </div>
                <div class="col-md-4">
                    <label class="form-label">Salary</label>
                    <input type="text" name="salary" class="form-control" placeholder="e.g. Negotiable">
                </div>
            </div>

            {{-- NEW: Tabbed Text Areas --}}
            <div class="mb-3">
                <label class="form-label">Context / General Description</label>
                <textarea name="description" rows="4" class="form-control" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Requirements (Bulleted list recommended)</label>
                <textarea name="requirements" rows="4" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Responsibilities (Bulleted list recommended)</label>
                <textarea name="responsibilities" rows="4" class="form-control"></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Compensation & Benefits (Bulleted list recommended)</label>
                <textarea name="benefits" rows="4" class="form-control"></textarea>
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