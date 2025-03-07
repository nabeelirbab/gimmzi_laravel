@component('mail::message')
# Hello Providers,

<h2>Someone is send to you request info for {{$details['name']}}</h2>

@component('mail::panel')
<p>Guest name:  <span>{{$details['guest_name']}}</span></p>
<p>Guest Phone:  <span>{{$details['guest_phone']}}</span></p>
<p>Guest Email:  <span>{{$details['guest_email']}}</span></p>
<p>Arrive Date:  <span>{{$details['arrive_date']}}</span></p>
<p>Departure Date:  <span>{{$details['departure_date']}}</span></p>
<p>Adult:  <span>{{$details['adult']}}</span></p>
<p>Children:  <span>{{$details['children']}}</span></p>
<p>Comment:  <span>{{$details['comment']}}</span></p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent