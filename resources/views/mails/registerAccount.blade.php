<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simposium Manado - Registrasi Akun</title>
    <!-- Tambahkan stylesheet atau inline styles sesuai kebutuhan -->
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
            width: 100px; /* Sesuaikan lebar logo sesuai kebutuhan */
            height: auto;
        }

        .registration-message {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            color: #525252;
            margin-bottom: 20px;
        }

        .registration-details {
            font-size: 14px;
            line-height: 22px;
            color: #525252;
            margin-bottom: 20px;
        }

        .registration-details p {
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
        <div class="registration-message">
            Registrasi Akun
        </div>

        <div class="registration-details">
            <p>
                Hai {{ $firstName }} {{ $lastName }},
            </p>
            <p>
               Terima kasih telah mendaftarkan akun di Simposium Manado. Kami sangat senang memiliki Anda sebagai bagian dari komunitas kami.
            </p>
            <!-- Tambahkan detail registrasi atau instruksi lebih lanjut sesuai kebutuhan -->
        </div>

        <div class="footer">
            Salam,<br>
            <a href="https://www.htmlemailtemplates.net" style="color:#2F67F6">Simposium Manado</a>
        </div>
    </div>

</body>

</html>
