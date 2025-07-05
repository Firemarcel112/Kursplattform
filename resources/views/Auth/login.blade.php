@extends('layouts.single')

@section('content')
    @include('partials.alerts')
    <form action="{{ route('login.store') }}" class="card card-md" method="POST" novalidate="">
        @csrf
        <div class="card-body">
            <h2 class="card-title text-center mb-4">{{ __('auth.login_title') }}</h2>
            <x-form.input label="{{ __('general.username') }}" name="name" />

            <x-form.input.password label="{{ __('general.password') }}" name="password" />

            <div class="form-footer">
                <button class="btn btn-primary w-100" type="submit">{{ __('auth.login_title') }}</button>
            </div>
        </div>
    </form>
@endsection
