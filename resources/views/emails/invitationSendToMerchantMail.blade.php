@component('mail::message')
# Hello {{$details['name']}},


 Welcome to Gimmzi-samrt Merchant Portal.Thank you for joinning {{$details['businessName']}} as a {{$details['role']}}. We are inviting you our merchant portal, here you can find your login credentials, please don't share these informations with others.
 This password is temporary password. After login for first time with below link, you will be immediately prompted to create a new password.  
@component('mail::panel')
<p><b>Email:</b> {{$details['email']}}</p>
<p><b>Password:</b> {{$details['password']}}</p>
@endcomponent
@component('mail::button', ['url' => $details['url']])
    Click To Login
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent