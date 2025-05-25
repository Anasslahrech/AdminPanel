<section>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold mb-0">
            <i class="bi bi-shield-lock me-2"></i>{{ __('Update Password') }}
        </h2>
    </div>

    @if (session('status') === 'password-updated')
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-2"></i>
                <div>{{ __('Password updated successfully.') }}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    <p class="text-muted mb-4">
        {{ __('Ensure your account is using a long, random password to stay secure.') }}
    </p>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Reste du formulaire inchangé -->
        <div class="mb-4">
            <label for="current_password" class="form-label fw-bold">{{ __('Current Password') }}</label>
            <input id="current_password" name="current_password" type="password"
                   class="form-control form-control-lg" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password" class="form-label fw-bold">{{ __('New Password') }}</label>
            <input id="password" name="password" type="password"
                   class="form-control form-control-lg" autocomplete="new-password">
            @error('password')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="password_confirmation" class="form-label fw-bold">{{ __('Confirm Password') }}</label>
            <input id="password_confirmation" name="password_confirmation" type="password"
                   class="form-control form-control-lg" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>{{ __('Save') }}
            </button>
        </div>
    </form>
</section>
