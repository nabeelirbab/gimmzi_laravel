@component('mail::message')
# Hello Consumer,



@component('mail::panel')
<p>Great news! As a valued guest of {{$details['building']}} - {{$details['apartment_name']}}, 
    you have been awarded a {{$details['building']}} - {{$details['apartment_name']}} Gimmzi Point Badge,
    which includes {{$details['point']}} points to 
    use on dining, shopping, and entertainment at any participating businesses that 
    accept Gimmzi Smart Rewards. Your badge will become active starting from the day of your arrival, {{$details['arrival_date']}}.
</p>

@component('mail::button', ['url' => url('accept-apartment-badge-request/' . $details['request_id']. '')])
    Accept Badge Request
@endcomponent

<p>
    To start redeeming your rewards, simply download the Gimmzi app using the link 
    below to add your new badge to your wallet. Then, you can start exploring all the 
    amazing deals and loyalty programs available at Gimmzi merchants in the area.
</p>

<p>
    Thank you for choosing {{$details['building']}} - {{$details['apartment_name']}}  for your stay. We hope you have a wonderful time and enjoy 
    all the perks that come with your {{$details['building']}} - {{$details['apartment_name']}}  Points Badge.
</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent