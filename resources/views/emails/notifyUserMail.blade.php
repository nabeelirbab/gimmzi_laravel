@component('mail::message')
# Hello {{$details['name']}},

{{$details['apartment']}} is now on the network.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
