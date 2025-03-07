@component('mail::message')
# Hello {{$details['name']}},

You have successfully reseting your password. Your new password is given below:

@component('mail::panel')
<p><b>Password:</b> {{$details['password']}}</p>
@endcomponent


Thanks,<br>
{{ config('app.name') }} Team
@endcomponent