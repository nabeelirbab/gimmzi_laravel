@component('mail::message')
# Hello {{$details['name']}},


Welcome to Gimmzi! We’re thrilled to have you join our community of savvy shoppers and rewards seekers. 🎊

With your Gimmzi membership, you now have access to exclusive deals, loyalty programs, and rewards at participating businesses across dining, shopping, entertainment, and more. 🛍️🍽️🎟️ We can’t wait for you to start exploring all the fantastic perks that come with being part of Gimmzi.

**What’s Next?** <br> 
To get started, if you haven’t already done so, download the Gimmzi app to unlock all the benefits waiting for you. 📲 Once your account is activated, you can start redeeming rewards and enjoying special offers at nearby Gimmzi merchants. 💸✨

<img src="{{ asset('admin_assets/media/mail.png') }}" alt="Mail Image" style="display: block; margin: 0 auto; width: 300px; height: auto;"/><br>

**Your Username** <br>
Don’t forget to keep track of your Gimmzi username: **{{$details['email']}}**. You’ll use this to log in and access your account.

**Need Help?** <br> 
If you have any questions or need assistance, feel free to reach out to our support team at support@gimmzi.com. 🛠️

Thank you for joining Gimmzi – we’re excited to help you discover and enjoy the best deals! 🎁


Best regards,<br>
{{ config('app.name') }} Team
@endcomponent