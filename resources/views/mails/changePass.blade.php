<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simposium Manado - Pemberitahuan Perubahan Sandi</title>
    <style>
        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            border: 1px solid #dddddd;
            margin-top: 20px;
            padding: 20px;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            height: auto;
        }

        .notification-message {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #525252;
            margin-bottom: 20px;
        }

        .notification-details {
            font-size: 14px;
            line-height: 22px;
            color: #525252;
            margin-bottom: 20px;
        }

        .notification-details p {
            margin: 13px 0;
        }

        .footer {
            text-align: left;
            font-size: 12px;
            line-height: 16px;
            color: #a2a2a2;
            margin-top: 20px;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="notification-message">
            Pemberitahuan Perubahan Sandi
        </div>

        <div class="notification-details">
            <p>
                Hai {{ $firstName }} {{ $lastName }},
            </p>
            <p>
                Kami ingin memberitahu Anda bahwa sandi akun Anda di Simposium Manado telah berhasil diubah. Jika Anda merasa tidak melakukan perubahan ini, segera hubungi kami.
            </p>
        </div>

        <div class="footer">
            Salam,<br>
            <a href="https://simopsiumanado.my.id/" style="color:#2F67F6">Simposium Manado</a>
        </div>
    </div>

</body>

</html>
