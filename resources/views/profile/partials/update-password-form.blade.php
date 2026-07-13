<h5 class="mb-3">Update Password</h5>
<p class="text-muted small mb-3">Ensure your account is using a long, random password to stay secure.</p>

<form method="POST" action="{{ route('password.update') }}">
    @csrf
    @method('PUT')

    <div class="mb-3">
        <label for="current_password" class="form-label">Current Password</label>
        <input id="current_password" name="current_password" type="password" class="form-control">
        @error('current_password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input id="password" name="password" type="password" class="form-control">
        @error('password', 'updatePassword') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm Password</label>
        <input id="password_confirmation" name="password_confirmation" type="password" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Save</button>
</form>