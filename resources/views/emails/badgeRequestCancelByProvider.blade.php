@component('mail::message')
# Hello Consumer,



@component('mail::panel')
<p>The invite has been canceled, however, you will continue to earn points monthly on your Gimmzi badge. 
    If you haven't already, to start redeeming your rewards, simply download the Gimmzi app using the link below. 
    Then, you can start exploring all the amazing deals and loyalty programs available at Gimmzi merchants in the area.
</p>
@endcomponent

Thanks,<br>
{{ config('app.name') }} Team
@endcomponent