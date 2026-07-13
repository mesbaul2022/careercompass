<h5 class="mb-3">Profile Information</h5>
<p class="text-muted small mb-3">Update your account's profile information and email address.</p>

<form method="POST" action="{{ route('profile.update') }}">
    @csrf
    @method('PATCH')

    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input id="name" name="name" type="text" class="form-control" value="{{ old('name', $user->name) }}" required autofocus>
        @error('name') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input id="email" name="email" type="email" class="form-control" value="{{ old('email', $user->email) }}" required>
        @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
    @if (session('status') === 'profile-updated')
        <span class="text-success small ms-2">Saved.</span>
    @endif
</form>