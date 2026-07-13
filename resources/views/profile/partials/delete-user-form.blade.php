<h5 class="mb-3 text-danger">Delete Account</h5>
<p class="text-muted small mb-3">Once deleted, all of your account's data is gone permanently. Download anything you want to keep first.</p>

<button type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
    Delete Account
</button>

<div class="modal fade" id="confirmDeleteModal" tabindex="-1">
    <div class="modal-dialog">
        <form method="POST" action="{{ route('profile.destroy') }}" class="modal-content">
            @csrf @method('DELETE')
            <div class="modal-header"><h5 class="modal-title">Confirm account deletion</h5></div>
            <div class="modal-body">
                <label class="form-label small">Enter your password to confirm</label>
                <input type="password" name="password" class="form-control">
                @error('password', 'userDeletion') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-danger">Delete Account</button>
            </div>
        </form>
    </div>
</div>