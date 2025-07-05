@component('mail::message')

    <p>{{ __('emails.greetings.default', ['name' => $user->name]) }},</p>

    <p>{{ __('emails.verify.text') }}</p>

    @component('mail::button', ['url' => $url])
        {{ __('emails.verify.button') }}
    @endcomponent

@endcomponent
