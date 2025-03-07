@component('mail::message')
# Hello {{$details['name']}},


Your password has been successfully reset. You can now log in to your account with your new password.

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent