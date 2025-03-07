@component('mail::message')
# Hello Consumer,



@component('mail::panel')
<p>Great news! As a valued guest of {{$details['company_name']}}, 
    you have been awarded a {{$details['company_name']}} Gimmzi Point Badge,
    which includes {{$details['point']}} points to 
    use on dining, shopping, and entertainment at any participating businesses that 
    accept Gimmzi Smart Rewards. Your badge will become active starting from the day of your arrival, {{$details['arrival_date']}}.
</p>

@component('mail::button', ['url' => url('accept-hotel-badge-request/' . $details['request_id']. '')])
Claim Your Badge
@endcomponent

<p>
    To start redeeming your rewards, simply download the Gimmzi app using the link 
    below to add your new badge to your wallet. Then, you can start exploring all the 
    amazing deals and loyalty programs available at Gimmzi merchants in the area.
</p>

<p>
    Thank you for choosing {{$details['company_name']}}  for your stay. We hope you have a wonderful time and enjoy 
    all the perks that come with your {{$details['company_name']}}  Points Badge.
</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent