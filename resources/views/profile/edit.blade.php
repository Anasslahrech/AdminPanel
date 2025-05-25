@extends('layouts.app')

@section('content')
<div class="container-fluid py-4">
    <div class="row mb-4">
        <div class="col-12">
            <div class="card border-0 shadow-lg bg-gradient-primary text-white">
                <div class="card-body py-4">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="mb-2 fw-bold">
                                <i class="bi bi-person-circle me-3"></i>{{ __('Profile') }}
                            </h1>
                            <p class="mb-0 opacity-75">{{ __('Manage your account settings') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-5">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card border-0 shadow-lg mb-4">
                <div class="card-body p-5">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card border-0 shadow-lg">
                <div class="card-body p-5">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
