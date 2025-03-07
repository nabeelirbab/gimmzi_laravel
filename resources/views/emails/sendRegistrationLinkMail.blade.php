@component('mail::message')
# Hello {{$details['name']}},

<p>We are gladly invited to Gimmzi Smart Reward Apartment Community.</p>
<p> One of our property manager is sent you registration link. Your building detail is :- </p>

@component('mail::panel')
<p><b>Building:</b> {{$details['building']}}</p>
<p><b>Unit:</b> {{$details['unit']}}</p>
<p><b>Access-code:</b> {{$details['code']}}</p>
@endcomponent

<p>To register in out site , please click on below link</p>

@component('mail::button', ['url' => $details['url']])
    Registration Link
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent