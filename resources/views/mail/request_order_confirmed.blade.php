<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Order Confirmed</title>
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
            color: #3E6E7A;
            margin-bottom: 10px;
        }
        .order-details {
            /* background: #f3f3f3; */
            padding: 10px;
            border-radius: 5px;
            margin: 20px 0;
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
        <img src="https://i.ibb.co.com/Zx2rrtx/email-header.png" alt="" style="width: 100%; height: 100%; object-fit: cover">
        <!-- Header -->
        <div class="header">
            <h1>Your Order Request Confirmed</h1>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Halo, *ini nanti diganti nama customer* !</h2>
            <p>Your order at <span style="color: #FF9D66">Hepi</span><span style="color: #3E6E7A">Korea</span> has been confirmed. We will process your shipment immediately.</p>
            
            <!-- Order Details -->
            <div class="order-details">
                <p><b>Order Number:</b> *ini nomor order*</p>
                <p><b>Order Date:</b> [Order date]</p>
                {{-- <p><b>Detail Produk:</b></p>
                <ul>
                    <li>Produk 1 - Rp 100.000</li>
                    <li>Produk 2 - Rp 50.000</li>
                </ul>
                <p><b>Total:</b> Rp 150.000</p> --}}
            </div>

            {{-- <p>Anda dapat memantau status pesanan Anda melalui tombol berikut:</p>
            <p style="text-align: center;">
                <a href="[Link Pemantauan]" 
                   style="display: inline-block; padding: 10px 20px; background: #4CAF50; color: #ffffff; text-decoration: none; border-radius: 5px;">
                    Lihat Status Pesanan
                </a>
            </p> --}}
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>If you have any questions, please contact us via <a href="mailto:support@namatoko.com">support@namatoko.com</a>.</p>
            <p>&copy; 2024 HepiKorea. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
