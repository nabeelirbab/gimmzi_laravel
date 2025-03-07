@component('mail::message')
# Hello {{$details['name']}},


<br>
<span>To reset your password please click on below link:-</span><br>
<a href="{{$details['url']}}/{{$details['token']}}">Reset Password </a>
<br>

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent
