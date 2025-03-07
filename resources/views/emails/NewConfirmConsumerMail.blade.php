@component('mail::message')
# Hello {{ $email }} ,

Welcome to Gimmzi-Smart Reward Portal.
Please click on the below link to complete the registration as a consumer.


@component('mail::button', ['url' => route('frontend.consumer-email-verification-mail', ['email' => $email])])
Registration Link
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent

