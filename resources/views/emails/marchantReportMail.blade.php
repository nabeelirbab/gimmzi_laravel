@component('mail::message')
# Hello {{$details['name']}},

@component('mail::panel')
<p><b>{{$details['report_name']}}</b> report is generated for you. Please see the attachment.</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent