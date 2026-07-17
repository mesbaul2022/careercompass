<x-app-layout>
    <x-slot name="header">
        <h2 class="h4 mb-0">Manage Study Materials</h2>
    </x-slot>

    <div class="d-flex justify-content-end mb-4">
        <a href="{{ route('admin.materials.create') }}" class="btn btn-primary">+ Upload Material</a>
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
                    <th>File</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse ($materials as $material)
                    <tr>
                        <td>{{ $material->category }}</td>
                        <td>{{ $material->title }}</td>
                        <td><a href="{{ asset('storage/' . $material->file_path) }}" target="_blank">View PDF</a></td>
                        <td class="text-end">
                            <form action="{{ route('admin.materials.destroy', $material) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Delete this material?')">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr><td colspan="4" class="text-muted text-center py-4">No materials uploaded yet.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>