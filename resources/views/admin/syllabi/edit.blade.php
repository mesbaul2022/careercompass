<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Edit Syllabus</h2>
    </x-slot>

    <div class="card cc-card p-4">
        <form action="{{ route('admin.syllabi.update', $syllabus) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label class="form-label">Category</label>
                <select name="category" class="form-select" required>
                    <option value="BCS" @selected($syllabus->category === 'BCS')>BCS</option>
                    <option value="Govt Bank" @selected($syllabus->category === 'Govt Bank')>Govt Bank</option>
                    <option value="Non-Govt" @selected($syllabus->category === 'Non-Govt')>Non-Govt Bank</option>
                    <option value="Engineering" @selected($syllabus->category === 'Engineering')>Engineering</option>
                    <option value="NGO" @selected($syllabus->category === 'NGO')>NGO</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Syllabus Title</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $syllabus->title) }}" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Content</label>
                <textarea name="content" rows="8" class="form-control" required>{{ old('content', $syllabus->content) }}</textarea>
            </div>
            <button class="btn btn-primary px-4">Update</button>
        </form>
    </div>
</x-app-layout>