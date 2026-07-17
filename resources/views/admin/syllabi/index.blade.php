<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Manage Syllabi</h2>
    </x-slot>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.syllabi.create') }}" class="btn btn-primary">+ New Syllabus</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card cc-card p-3">
        <table class="table align-middle mb-0">
            <thead>
                <tr>
                    <th>Category</th>
                    <th>Title</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($syllabi as $syllabus)
                    <tr>
                        <td>{{ $syllabus->category }}</td>
                        <td>{{ $syllabus->title }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.syllabi.edit', $syllabus) }}" class="btn btn-sm btn-outline-secondary">Edit</a>
                            <form action="{{ route('admin.syllabi.destroy', $syllabus) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this syllabus?')">
                                @csrf 
                                @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-muted text-center py-4">No syllabi added yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>