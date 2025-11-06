<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bukti Pesanan - Munir Jaya Abadi</title>
    <style>
        /* Reset styles */
        body,
        table,
        td,
        a {
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            -ms-interpolation-mode: bicubic;
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
        }

        body {
            height: 100% !important;
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
        }

        /* Prevent iOS auto scaling */
        @media screen and (max-width: 600px) {
            table[class="container"] {
                width: 100% !important;
            }

            td[class="mobile-padding"] {
                padding: 20px 15px !important;
            }

            table[class="mobile-button"] {
                width: 100% !important;
            }
        }
    </style>
</head>

<body
    style="margin: 0 !important; padding: 0 !important; background-color: #f4f6fb; font-family: 'Segoe UI', Arial, sans-serif;">

    <!-- Preheader text -->
    <div
        style="display: none; font-size: 1px; color: #f4f6fb; line-height: 1px; font-family: 'Segoe UI', Arial, sans-serif; max-height: 0px; max-width: 0px; opacity: 0; overflow: hidden;">
        Pesanan Anda telah berhasil dibuat dan sedang diproses.
    </div>

    <!-- Main container -->
    <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
        style="background-color: #f4f6fb; padding: 32px 0;">
        <tr>
            <td align="center" style="padding: 0 16px;">
                <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                    style="max-width: 640px; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(15,23,42,.08);">

                    <!-- Header section -->
                    <tr>
                        <td align="center"
                            style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 32px 24px; color: #ffffff;">
                            <h1 style="margin: 0 0 8px 0; font-size: 28px; letter-spacing: 0.4px; font-weight: 600;">🛍️
                                Pesanan Berhasil Dibuat</h1>
                            <p style="margin: 8px 0 0; font-size: 16px; color: #f3f4f6;">Nomor Pesanan:
                                #{{ $order->id }}</p>
                            <p style="margin: 4px 0 0; font-size: 14px; color: #f3f4f6;">Munir Jaya Abadi</p>
                        </td>
                    </tr>

                    <!-- Content section -->
                    <tr>
                        <td class="mobile-padding"
                            style="padding: 32px 28px 0; color: #0f172a; font-family: 'Segoe UI', Arial, sans-serif;">

                            <!-- Greeting -->
                            <p style="margin: 0 0 16px; font-size: 16px;">Halo
                                <strong>{{ $order->user->name }}</strong>,
                            </p>

                            <!-- Thank you message -->
                            <p style="margin: 0 0 24px; font-size: 15px; line-height: 1.6; color: #475569;">
                                Terima kasih telah mempercayakan kebutuhan Anda kepada <strong>Munir Jaya
                                    Abadi</strong>.
                                Pesanan Anda sedang kami proses dan akan segera dikirimkan.
                            </p>

                            <!-- Order summary -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                style="background-color: #f8fafc; border-radius: 12px; padding: 20px 24px; margin-bottom: 28px;">
                                <tr>
                                    <td colspan="2"
                                        style="font-size: 16px; font-weight: 600; color: #0f172a; padding-bottom: 12px;">
                                        Ringkasan Pesanan</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; font-size: 14px; color: #64748b;">Tanggal</td>
                                    <td align="right"
                                        style="padding: 6px 0; font-size: 14px; color: #0f172a; font-weight: 500;">
                                        {{ $order->created_at->format('d F Y, H:i') }} WIB</td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; font-size: 14px; color: #64748b;">Status Pembayaran</td>
                                    <td align="right"
                                        style="padding: 6px 0; font-size: 14px; color: #0f172a; font-weight: 600;">
                                        {{ $order->payment_status === 'paid' ? 'Lunas' : 'Menunggu Pembayaran' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 6px 0; font-size: 14px; color: #64748b;">Metode Pembayaran</td>
                                    <td align="right"
                                        style="padding: 6px 0; font-size: 14px; color: #0f172a; font-weight: 500;">
                                        {{ strtoupper($order->payment_method) }}
                                    </td>
                                </tr>
                                <tr>
                                    <td
                                        style="padding: 10px 0; font-size: 14px; color: #64748b; border-top: 1px solid #e2e8f0;">
                                        Total Pembayaran</td>
                                    <td align="right"
                                        style="padding: 10px 0; font-size: 18px; color: #0f172a; font-weight: 700; border-top: 1px solid #e2e8f0;">
                                        Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                    </td>
                                </tr>
                            </table>

                            <!-- Order items table -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                style="margin-bottom: 28px; border: 1px solid #e2e8f0; border-radius: 12px; overflow: hidden;">
                                <thead>
                                    <tr style="background-color: #0f172a; color: #ffffff;">
                                        <th align="left"
                                            style="padding: 14px 18px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.6px;">
                                            Produk</th>
                                        <th align="center"
                                            style="padding: 14px 18px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.6px;">
                                            Jumlah</th>
                                        <th align="right"
                                            style="padding: 14px 18px; font-size: 13px; text-transform: uppercase; letter-spacing: 0.6px;">
                                            Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($order->items as $item)
                                        <tr style="background-color: #ffffff; color: #0f172a;">
                                            <td
                                                style="padding: 14px 18px; font-size: 14px; border-bottom: 1px solid #f1f5f9;">
                                                {{ $item->product->name }}
                                            </td>
                                            <td align="center"
                                                style="padding: 14px 18px; font-size: 14px; border-bottom: 1px solid #f1f5f9; color: #475569;">
                                                {{ $item->quantity }}
                                            </td>
                                            <td align="right"
                                                style="padding: 14px 18px; font-size: 14px; border-bottom: 1px solid #f1f5f9; font-weight: 600;">
                                                Rp {{ number_format($item->total_amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endforeach

                                    <!-- Subtotal (Produk Only) -->
                                    <tr style="background-color: #f8fafc;">
                                        <td colspan="2" style="padding: 12px 18px; font-size: 14px; color: #64748b;">
                                            Subtotal Produk</td>
                                        <td align="right"
                                            style="padding: 12px 18px; font-size: 14px; font-weight: 600; color: #0f172a;">
                                            Rp
                                            {{ number_format($order->grand_total - ($order->shipping_amount ?? 0), 0, ',', '.') }}
                                        </td>
                                    </tr>

                                    <!-- Shipping Cost -->
                                    @if ($order->shipping_amount > 0)
                                        <tr style="background-color: #f8fafc;">
                                            <td colspan="2"
                                                style="padding: 12px 18px; font-size: 14px; color: #64748b;">
                                                Ongkos Kirim
                                                @if ($order->shipping_method)
                                                    <br>
                                                    <span style="font-size: 12px; color: #94a3b8;">
                                                        {{ $order->shipping_method }}
                                                        @if ($order->shipping_etd)
                                                            ({{ $order->shipping_etd }})
                                                        @endif
                                                    </span>
                                                @endif
                                            </td>
                                            <td align="right"
                                                style="padding: 12px 18px; font-size: 14px; font-weight: 600; color: #10b981;">
                                                Rp {{ number_format($order->shipping_amount, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                    @endif

                                    <!-- Grand Total -->
                                    <tr style="background-color: #0f172a;">
                                        <td colspan="2"
                                            style="padding: 16px 18px; font-size: 15px; color: #ffffff; font-weight: 700; text-transform: uppercase; letter-spacing: 0.4px;">
                                            Total Pembayaran</td>
                                        <td align="right"
                                            style="padding: 16px 18px; font-size: 18px; font-weight: 700; color: #10b981;">
                                            Rp {{ number_format($order->grand_total, 0, ',', '.') }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>

                            <!-- Shipping Address (if exists) -->
                            @if ($order->address)
                                <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                    style="background: linear-gradient(135deg, #f0fdf4 0%, #dcfce7 100%); border-radius: 12px; padding: 20px 24px; margin-bottom: 28px; border: 1px solid #bbf7d0;">
                                    <tr>
                                        <td>
                                            <h3
                                                style="margin: 0 0 12px; font-size: 15px; font-weight: 600; color: #166534;">
                                                📦 Alamat Pengiriman
                                            </h3>
                                            <p
                                                style="margin: 0 0 6px; font-size: 14px; color: #15803d; font-weight: 600;">
                                                {{ $order->address->first_name }} {{ $order->address->last_name }}
                                            </p>
                                            <p
                                                style="margin: 0 0 4px; font-size: 14px; color: #166534; line-height: 1.5;">
                                                {{ $order->address->street_address }}
                                            </p>
                                            <p style="margin: 0 0 4px; font-size: 14px; color: #166534;">
                                                {{ $order->address->city }}, {{ $order->address->state }}
                                                {{ $order->address->zip_code }}
                                            </p>
                                            <p style="margin: 0; font-size: 14px; color: #166534;">
                                                📱 {{ $order->address->phone }}
                                            </p>

                                            @if ($order->shipping_destination_name)
                                                <p
                                                    style="margin: 12px 0 0; padding-top: 12px; border-top: 1px solid #bbf7d0; font-size: 13px; color: #15803d;">
                                                    <strong>Tujuan:</strong> {{ $order->shipping_destination_name }}
                                                </p>
                                            @endif
                                        </td>
                                    </tr>
                                </table>
                            @endif

                            <!-- CTA button -->
                            <div style="text-align: center; margin-bottom: 32px;">
                                <table role="presentation" cellpadding="0" cellspacing="0" class="mobile-button">
                                    <tr>
                                        <td align="center"
                                            style="border-radius: 999px; background: linear-gradient(135deg, #10b981, #059669);">
                                            <a href="{{ $url }}" target="_blank"
                                                style="font-size: 16px; font-family: 'Segoe UI', Arial, sans-serif; color: #ffffff; text-decoration: none; border-radius: 999px; padding: 14px 32px; border: 1px solid #10b981; display: inline-block; font-weight: 600;">
                                                Lihat Detail Pesanan
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                            </div>

                            <!-- Support message -->
                            <table role="presentation" cellpadding="0" cellspacing="0" width="100%"
                                style="background-color: #f1f5f9; border-radius: 12px; padding: 18px 20px; margin-bottom: 24px;">
                                <tr>
                                    <td style="font-size: 14px; color: #475569; line-height: 1.6;">
                                        Ada pertanyaan seputar pesanan ini? Balas email ini atau hubungi tim dukungan
                                        kami.
                                        Kami siap membantu setiap saat.
                                    </td>
                                </tr>
                            </table>

                            <!-- Signature -->
                            <p style="margin: 0; font-size: 14px; color: #64748b; line-height: 1.6;">
                                Hangatnya salam,<br>
                                <strong>Tim Munir Jaya Abadi</strong><br>
                                <span style="color: #94a3b8;">{{ config('mail.from.address') }}</span>
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td align="center"
                            style="padding: 24px; font-size: 12px; color: #94a3b8; background-color: #f8fafc;">
                            © {{ now()->year }} Munir Jaya Abadi. Semua hak dilindungi.
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>
