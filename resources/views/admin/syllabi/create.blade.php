<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Add New Syllabus</h2>
    </x-slot>

    <div class="card cc-card p-4">
        <form action="{{ route('admin.syllabi.store') }}" method="POST">
            @csrf
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
                <label class="form-label">Syllabus Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="8" class="form-control" required></textarea>
            </div>
            <button class="btn btn-primary px-4">Save</button>
        </form>
    </div>
</x-app-layout>