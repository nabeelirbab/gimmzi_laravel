@component('mail::message')
# Hello {{$details['name']}},

Welcome to Gimmzi! 🎉 To complete your registration, please verify your email by clicking the button below:


@component('mail::button', ['url' => $details['url']])
   Activate Account
@endcomponent

Activating your account will give you full access to exclusive deals, loyalty programs, and more. 🛍️✨

Please note, if the account remains inactive for 14 days, it will be inactivated. We encourage you to activate your account soon so you don’t miss out on any of our exciting benefits! 🎁

If you have any questions or need assistance, don’t hesitate to contact our support team at support@gimmzi.com. 🛠️

Thank you for joining Gimmzi Smart Rewards! 🙌


Best regards,<br>
{{ config('app.name') }} Team
@endcomponent
