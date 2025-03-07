@component('mail::message')
# Hello {{$details['name']}},


 {{-- Welcome to Gimmzi-smart {{$details['portalType']}} Provider Portal.Thank you for joinning {{$details['travel_type']}} as a {{$details['role']}}. We are inviting you our {{$details['portalType']}} provider portal, here you can find your login credentials, please don't share these informations with others.
 This password is temporary password. After login for first time with below link, you will be immediately prompted to create a new password.   --}}

 <p>You’ve been invited to join the Gimmzi Smart Travel and Tourism Portal by {{$details['sender_name']}}. Below are your login credentials. Please keep this information confidential, as the password is temporary. After logging in for the first time using the link below, you’ll be prompted to create a new password.</p>

@component('mail::panel')
<p><b>Email:</b> {{$details['email']}}</p>
<p><b>Password:</b> {{$details['password']}}</p>
@endcomponent
@component('mail::button', ['url' => $details['url']])
    Click To Login
@endcomponent 
<p>
    This grants you access to {{$details['travel_type']}}'s Gimmzi portal, where you can elevate customer engagement and enhance the travel experience with unique rewards. With this platform, you'll have the tools to provide even more exciting and rewarding journeys for your customers.
</p>

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
