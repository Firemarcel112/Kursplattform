@extends('layouts.single')

@section('content')
    <form action="{{ route('register.store') }}" class="card card-md" method="POST" novalidate="">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('auth.register_title') }}</h2>
            <x-form.input label="{{ __('general.username') }}" name="name" required />

            <x-form.input label="{{ __('general.email') }}" name="email" required type="email" />

            <x-form.input.password label="{{ __('general.password') }}" name="password" required />

            <div class="mb-3">
                <label class="form-check">
                    <input class="form-check-input" name="terms_of_service" type="checkbox">
                    <span class="form-check-label @error('terms_of_service') invalid-feedback @enderror">{{ __('auth.accept_terms', [
                        'a_open' => '',
                        'a_close' => '',
                    ]) }}</a>.
                    </span>
                </label>
                @error('terms_of_service')
                    <div class="d-block invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-footer">
                <button class="btn btn-primary w-100" type="submit">{{ __('auth.register_title') }}</button>
            </div>
        </div>
    </form>
    <div class="text-center text-secondary mt-3">{!! __('auth.already_account', [
        'a_open' => '<a href="' . route('login.index') . '">',
        'a_close' => '</a>',
    ]) !!}</div>
    </div>
@endsection
