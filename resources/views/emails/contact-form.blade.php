<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }

        .content {
            background: #f9f9f9;
            padding: 30px;
            border: 1px solid #e0e0e0;
        }

        .info-row {
            margin-bottom: 20px;
            padding: 15px;
            background: white;
            border-radius: 5px;
            border-left: 4px solid #667eea;
        }

        .label {
            font-weight: bold;
            color: #667eea;
            display: block;
            margin-bottom: 5px;
        }

        .value {
            color: #333;
        }

        .message-box {
            background: white;
            padding: 20px;
            border-radius: 5px;
            border: 1px solid #e0e0e0;
            margin-top: 20px;
        }

        .footer {
            text-align: center;
            padding: 20px;
            color: #666;
            font-size: 12px;
            background: #f0f0f0;
            border-radius: 0 0 10px 10px;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1 style="margin: 0;">📧 Pesan Baru dari Contact Form</h1>
        <p style="margin: 10px 0 0 0;">Munir Jaya Abadi</p>
    </div>

    <div class="content">
        <p style="margin-top: 0;">Anda mendapat pesan baru dari contact form website:</p>

        <div class="info-row">
            <span class="label">👤 Nama:</span>
            <span class="value">{{ $contactData['name'] }}</span>
        </div>

        <div class="info-row">
            <span class="label">📧 Email:</span>
            <span class="value">
                <a href="mailto:{{ $contactData['email'] }}">{{ $contactData['email'] }}</a>
            </span>
        </div>

        <div class="info-row">
            <span class="label">📱 Nomor Telepon:</span>
            <span class="value">{{ $contactData['phone'] }}</span>
        </div>

        <div class="info-row">
            <span class="label">📌 Subjek:</span>
            <span class="value">{{ $contactData['subject'] }}</span>
        </div>

        <div class="message-box">
            <span class="label">💬 Pesan:</span>
            <div class="value" style="margin-top: 10px; white-space: pre-wrap;">{{ $contactData['message'] }}</div>
        </div>

        <div
            style="margin-top: 30px; padding: 15px; background: #e8f4fd; border-radius: 5px; border-left: 4px solid #2196F3;">
            <p style="margin: 0; font-size: 14px;">
                <strong>💡 Tips:</strong> Anda dapat membalas email ini langsung dengan mengklik tombol reply di email
                client Anda.
            </p>
        </div>
    </div>

    <div class="footer">
        <p style="margin: 5px 0;">Email dikirim pada: {{ now()->format('d F Y, H:i:s') }} WIB</p>
        <p style="margin: 5px 0;">© {{ date('Y') }} Munir Jaya Abadi. All rights reserved.</p>
    </div>
</body>

</html>
