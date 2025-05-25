<section>
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="h4 fw-bold mb-0">
            <i class="bi bi-person-lines-fill me-2"></i>{{ __('Profile Information') }}
        </h2>
    </div>

    <p class="text-muted mb-4">
        {{ __("Update your account's profile information and email address.") }}
    </p>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="mb-4">
            <label for="name" class="form-label fw-bold">{{ __('Name') }}</label>
            <input id="name" name="name" type="text" class="form-control form-control-lg"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
            <input id="email" name="email" type="email" class="form-control form-control-lg"
                   value="{{ old('email', $user->email) }}" required autocomplete="email">
            @error('email')
                <div class="text-danger mt-2">{{ $message }}</div>
            @enderror

            <!-- Section vérification email -->
            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-3">
                    <div class="alert alert-warning">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <div>
                                {{ __('Your email address is unverified.') }}
                                <button form="send-verification" class="btn btn-link p-0 text-warning">
                                    {{ __('Click here to re-send the verification email.') }}
                                </button>
                            </div>
                        </div>
                    </div>

                    @if (session('status') === 'verification-link-sent')
                        <div class="alert alert-success">
                            <div class="d-flex align-items-center">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                <div>{{ __('A new verification link has been sent to your email address.') }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            @elseif(session('status') === 'profile-updated')
                <div class="alert alert-success mt-3">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        <div>{{ __('Profile updated successfully.') }}</div>
                    </div>
                </div>
            @endif
        </div>

        <div class="d-flex justify-content-end mt-4">
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="bi bi-check-circle me-2"></i>{{ __('Save') }}
            </button>
        </div>
    </form>
</section>
