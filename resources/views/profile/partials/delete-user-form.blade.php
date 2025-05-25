<section>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold mb-0 text-danger">
            <i class="bi bi-exclamation-triangle me-2"></i>{{ __('Delete Account') }}
        </h2>
    </div>

    <div class="alert alert-danger">
        <p class="mb-0">
            {{ __('Once your account is deleted, all of its resources and data will be permanently deleted. Before deleting your account, please download any data or information that you wish to retain.') }}
        </p>
    </div>

    <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirm-user-deletion">
        <i class="bi bi-trash me-2"></i>{{ __('Delete Account') }}
    </button>

    <div class="modal fade" id="confirm-user-deletion" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title">{{ __('Delete Account') }}</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <p>{{ __('Are you sure you want to delete your account? Once deleted, all data will be permanently lost.') }}</p>

                    <form method="post" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <div class="mb-3">
                            <label for="password" class="form-label">{{ __('Password') }}</label>
                            <input type="password" class="form-control" name="password"
                                   placeholder="{{ __('Enter your password to confirm') }}" required>
                            @error('password')
                                <div class="text-danger mt-2">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('Cancel') }}
                            </button>
                            <button type="submit" class="btn btn-danger">
                                {{ __('Delete Account') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
