<!DOCTYPE html>
<html>

<head>
    <title>GIMMZI</title>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body style="padding: 0;margin: 0;box-sizing: border-box;color: #000000;">
    <table width="640"
        style="font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; box-sizing: border-box; padding: 0; margin: 0 auto;"
        cellpadding="0" cellspacing="0">
        <tbody>
            <tr>
                <td style="padding-top: 50px;" colspan="2"><a href="javascript:void(0)"
                        style="display: block;margin: 0 auto 10px;width: 150px;"><img
                            src="{{ $mail_data['hotel_logo'] }}" alt="" style="width: 100%;"></a></td>
            </tr>
            <tr>
                <td colspan="2">
                    <p
                        style="margin: 0;text-align: center;font-size: 20px;font-weight: 400;margin-bottom: 15px;word-break: break-word;">
                        {{ $mail_data['message'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding-bottom: 30px;" colspan="2">
                    <p style="margin: 0;text-align: center;font-size: 18px;font-weight: 400;">-{{ $mail_data['hotel_name'] }}
                    </p>
                </td>
            </tr>
            <tr>
                <td style="box-sizing: border-box; width: 52%;padding: 0 0 30px 0;"><img
                        src="{{ $mail_data['main_image'] }}" alt=""
                        style="width: 100%;height: 100%;object-fit: cover;"></td>
                <td style="box-sizing: border-box; padding: 0 0 30px 20px; width: 48%;">
                    <h1
                        style="font-size: 26px;line-height: 1.23em;letter-spacing: 0.01em;color: #000000;margin: 0 0 10px;">
                        {{ $mail_data['hotel_name'] }} </h1>
                   
                    @if ($mail_data['amenities'] || $mail_data['features'])
                        <p style="margin: 0 0 5px;font-size: 18px;color: #010101;font-weight: 500;">Featured Amenities:
                        </p>
                        <p style="margin: 0 0 15px;font-size: 16px;color: #707070;line-height: 1.4;">
                            {{ $mail_data['features'] }},{{ $mail_data['amenities'] }}
                        </p>
                    @endif

                    <a href="{{ route('frontend.hotel_resort.hotel-resort-website', $mail_data['encrypt_id']) }}"
                        style="display: inline-block;padding: 12px 30px;background: #26A7DF;color: #ffffff;border-radius: 6px;text-decoration: none;font-weight: 400;line-height: 1;font-size: 18px;">View
                        Hotel </a>
                </td>
            </tr>
            <tr>

                <td colspan="2">
                    <a href="{{ route('frontend.travel-tourism.list') }}"><img
                            src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/mail_search.png"
                            alt="alt"></a>
                </td>

            </tr>
            <tr>
                <td
                    style="box-sizing: border-box;padding: 30px 0 30px 0;text-align: center;font-size: 18px;color: #000;">
                    <p><a href="tel:8444446694"
                            style="color: #000 !important;text-decoration: none !important;">8444446694</a> or (844)
                        4GIMMZI</p>
                </td>
                <td
                    style="box-sizing: border-box;padding: 30px 0 30px 0;text-align: center;font-size: 18px;color: #000;">
                    <a target="_blank" href="{{ route('frontend.index') }}" style="color: #000 !important;">Visit
                        Gimmzi Explore Page</a>
                </td>
            </tr>
            <tr>
                <td>
                    <a href="{{ route('frontend.index') }}" style="display: block;width: 208px;margin: 0 auto;">
                        <img style="width: 100%;"
                            src="https://gimmzi-smart.dedicateddevelopers.us/frontend_assets/images/logosmart-reward.svg"
                            alt="">
                    </a>
                </td>
                <td style="text-align: center;">
                    <a target="_blank" href="https://www.facebook.com/GimmziSmartRewards"
                        style="display: inline-block;width: 40px;margin: 0 25px 0 0;">
                        <img style="width: 100%;"
                            src="https://angularjsdevelopment.com/custom/gimmzi-portal/images/facebook.svg"
                            alt=""></a>
                    <a target="_blank" href="https://www.instagram.com/gimmzi"
                        style="display: inline-block;width: 40px;">
                        <img style="width: 100%;"
                            src="https://angularjsdevelopment.com/custom/gimmzi-portal/images/instagram.svg"
                            alt="">
                    </a>
                </td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: center;padding: 20px 0 20px 0;">
                    <p style="margin: 0;font-size: 15px;text-align: center;">This message was sent by
                        {{ $mail_data['name'] }} from
                        <a style="color: #000;text-decoration: none;"
                            href="mailto:{{ $mail_data['email'] }}">{{ $mail_data['email'] }}</a> via Gimmzi Smart
                        Rewards
                    </p>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>
