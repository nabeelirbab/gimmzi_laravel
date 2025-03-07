@component('mail::message')
# Hello {{$details['name']}},


 <p>You’ve been invited to join the Gimmzi Smart Community Portal by {{$details['sender_name']}}. Below are your login credentials. Please keep this information confidential, as the password is temporary. After logging in for the first time using the link below, you’ll be prompted to create a new password.</p>
@component('mail::panel')
<p><b>Email:</b> {{$details['email']}}</p>
<p><b>Temporary Password:</b> {{$details['password']}}</p>
@endcomponent
@component('mail::button', ['url' => $details['url']])
    Click To Login
@endcomponent

<p>This grants you access to {{$details['property']}}'s Gimmzi portal, giving you the tools to enhance resident engagement and boost participation in your rewards program. With this platform, you'll be able to create even more rewarding experiences for your community.</p>


Thanks,<br>
{{ config('app.name') }} Team
@endcomponent


