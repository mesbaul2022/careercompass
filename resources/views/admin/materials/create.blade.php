<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Upload Study Material</h2>
    </x-slot>

    <div class="card cc-card p-4">
        <form action="{{ route('admin.materials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
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
            <div class="mb-3">
                <label class="form-label">Title</label>
                <input type="text" name="title" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label">PDF File</label>
                <input type="file" name="file" accept="application/pdf" class="form-control" required>
            </div>
            <button class="btn btn-primary px-4">Upload</button>
        </form>
    </div>
</x-app-layout>