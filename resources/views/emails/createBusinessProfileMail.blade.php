@component('mail::message')
# Hello {{$details['name']}},

<h2>Congratulations</h2>

@component('mail::panel')
<p>You have successfully created your first deal.</p>
<p>A Gimmzi staff member will reach out to you via email within the next 24-48 hours to complete the setup.</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent