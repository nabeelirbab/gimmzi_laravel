<!DOCTYPE html>
<html lang="en">

<head>
  
    <title>Gimmzi Portal</title>

</head>

<body style="margin: 0; padding: 0;">
  <table cellspacing="0" cellpadding="0" border="0" width="100%"
  style="margin: 0 auto; color: #000000; font-size: 12px; font-weight: 400; background: #ffffff; font-family: 'Arial', Helvetica, sans-serif; line-height: 1.5; vertical-align: top; border-collapse: collapse; table-layout: fixed; border: 2px solid #000000;">
  <tr>
    <td width="100%" style=" padding: 20px 15px 20px; text-align: center;">
        <h2 style="margin: 0 0 5px; font-size: 24px; color: #26a7df; line-height: 1;">Welcome to {{$city}}, {{$state}}</h2>
        <h3 style="margin: 0 0 10px; font-size: 18px; font-weight: bold;">We're excited to have you as our guest at {{$provider_name}}! </h3>
        <p style="margin: 0 0 10px;">As a thank you for staying with us, we'd like to introduce you 
            to <a href="#" style="text-decoration: none; color: #26a7df;">Gimmzi Smart Rewards</a>– a new way to discover 
            local attractions and businesses while earning rewards!</p>
        <p style="margin: 0 0 10px;">Simply scan the QR code with your smartphone and you'll be directed 
            to the Gimmzi app. From there, you can browse through a list of local 
            businesses that participate in our rewards program. By checking in, making a 
            purchase, or referring a friend, you'll earn points that you can
            redeem for discounts, freebies, and more.!</p>
        <p style="margin: 0;">Here are just a few examples of the rewards you can earn:</p>
    </td>
  </tr>
  <tr>
    <td width="100%" style=" padding: 20px 15px 20px; text-align: center;">
       
        <p style="margin: 0 0 10px;">Free coffee at a nearby café</p>
        <p style="margin: 0 0 10px;">10% off your bill at a popular restaurant</p>
        <p style="margin: 0;">A free mini-golf game at a local attraction</p>
        <p style="margin: 0;">A discount on a spa treatment at a nearby resort</p>
    </td>
  </tr>
  <tr>
    <td width="100%" style=" padding: 0 15px 20px;">
        <table cellspacing="0" cellpadding="0" border="0" width="100%" style="border-collapse: collapse;">
            <tr>
                <td style="vertical-align: middle; width: 25%;"></td>
                <td style="vertical-align: middle; width: 25%;">
                    <div style="max-width: 220px; width: 100%; margin-left: auto;">
                        <img src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/gimmzilogo.jpg" style="width: 100%;"alt="">
                    </div>
                </td>
                <td style="vertical-align: middle; width: 25%; padding-left: 10px;">
                    <div style="display: block; border-radius: 10px; width: 100%; max-width: 150px; overflow: hidden;">
                            <img style="width: 100%;" src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(256)->generate($text)) !!} ">
                    </div>
                </td>
                <td style="vertical-align: middle; width: 25%;"></td>
            </tr>
        </table>
    </td>
  </tr>
  </table>
</body>

</html>
