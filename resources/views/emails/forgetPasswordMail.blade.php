@component('mail::message')
# Hello {{$details['name']}},

To reset your password, please click the button below:

@component('mail::button', ['url' => $details['url']])
    Reset Password
@endcomponent

If you did not request a password reset, please disregard this email.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent