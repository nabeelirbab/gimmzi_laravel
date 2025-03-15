<!DOCTYPE html>
<html>

<head>
    <title>{{ $data['emailSubject'] }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f7fc;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .email-container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .email-header {
            text-align: center;
            background-color: #26a1d6;
            padding: 15px;
            color: #fff;
            border-radius: 8px 8px 0 0;
        }

        .email-header h1 {
            margin: 0;
            font-size: 24px;
        }

        .email-body {
            padding: 20px;
        }

        .email-body p {
            line-height: 1.6;
            font-size: 16px;
        }

        .email-body a {
            color: #26a1d6;
            text-decoration: none;
        }

        .email-footer {
            text-align: center;
            font-size: 14px;
            color: #888;
            margin-top: 20px;
        }

        .button {
            background-color: #26a1d6;
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-weight: bold;
            display: inline-block;
            margin-top: 15px;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <div class="email-header">
            <h1>{{ $data['emailSubject'] }}</h1>
        </div>

        <div class="email-body">
            <p>Hi,</p>
            <p>{{ $data['yourName'] }} wants to share a listing with you.</p>

            <p><strong>Subject:</strong> {{ $data['emailSubject'] }}</p>

            <p><strong>Listing Link:</strong></p>
            <p><a href="{{ $data['message'] }}" target="_blank">{{ $data['message'] }}</a></p>

            <p>Best Regards,</p>
            <p>{{ $data['yourName'] }}</p>
        </div>

        <div class="email-footer">
            <p>&copy; {{ date('Y') }} Gimmzi. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
