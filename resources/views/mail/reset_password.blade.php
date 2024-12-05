{{-- <div>
    OTP code: {{ $code }}
</div> --}}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            /* background-color: #f9f9f9; */
            color: #333;
        }

        .email-container {
            max-width: 600px;
            margin: 20px auto;
            /* background: #ffffff; */
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        .header {
            background: #FF9D66;
            color: #ffffff;
            padding: 20px;
        }

        .header h1 {
            margin: 0;
        }

        .content {
            padding: 20px;
            line-height: 1.6;
        }

        .content h2 {
            margin-bottom: 10px;
        }


        .footer {
            background: #eeeeee;
            text-align: center;
            padding: 15px;
            font-size: 12px;
            color: #666;
        }

        .footer a {
            color: #FF9D66;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <div class="email-container">
        <img src="https://i.ibb.co.com/Zx2rrtx/email-header.png" alt=""
            style="width: 100%; height: 100%; object-fit: cover">
        <!-- Header -->
        <div class="header">
            <h1>Reset Your Password</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2 style="color: #3E6E7A">Halo, *ini nanti diganti nama customer* !</h2>
            <p>We received a request to reset your password for your account at <span style="color: #FF9D66">Hepi</span><span style="color: #3E6E7A">Korea</span></p>
            <p>If you requested this change, please click the button below to reset your password. If you did not request this, you can safely ignore this email.</p>


            <p>Use the following code to reset your password:</p>
            <h3>OTP code:</h3>
            <div style="text-align: center"><h1 style="font-size: 40px; color: #FF9D66">  $code </h1></div>
            {{-- <h2>OTP code: {{ $code }}</h2> --}}
            <p>If you did not request this verification, ignore this email.</p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you have any questions, please contact us via <a
                    href="mailto:support@namatoko.com">support@namatoko.com</a>.</p>
            <p>&copy; 2024 HepiKorea. All rights reserved.</p>
        </div>
    </div>
</body>

</html>
