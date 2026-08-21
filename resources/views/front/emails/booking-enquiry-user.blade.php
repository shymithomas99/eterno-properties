<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Enquiry Received</title>
</head>

<body style="margin:0;padding:20px;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="max-width:700px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e5e5e5;">

        <tr>
            <td style="background:#0d6efd;padding:20px;text-align:center;">
                <h2 style="margin:0;color:#ffffff;">Booking Enquiry Received</h2>
            </td>
        </tr>



        <tr>
            <td style="padding:25px;">
                <p style="margin-top:0;font-size:15px;">Thank you for your booking enquiry. Our reservations team will
                    review your request and get back to you shortly.</p>

                <table width="100%" cellpadding="10" cellspacing="0" border="0"
                    style="border-collapse:collapse;font-size:14px;">

                    <tr style="background:#fff3cd;">
                        <td width="30%" style="font-weight:bold;border:1px solid #dee2e6;">
                            Enquiry From
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $website }}
                        </td>
                    </tr>

                    <tr style="background:#f8f9fa;">
                        <td width="30%" style="font-weight:bold;border:1px solid #dee2e6;">Name</td>
                        <td style="border:1px solid #dee2e6;">{{ $enquiry->name }}</td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;border:1px solid #dee2e6;">Email</td>
                        <td style="border:1px solid #dee2e6;">{{ $enquiry->email }}</td>
                    </tr>

                    @if ($enquiry->resort)
                        <tr style="background:#f8f9fa;">
                            <td style="font-weight:bold;border:1px solid #dee2e6;">Preferred Room</td>
                            <td style="border:1px solid #dee2e6;">{{ $enquiry->resort }}</td>
                        </tr>
                    @endif

                    <tr>
                        <td style="font-weight:bold;border:1px solid #dee2e6;vertical-align:top;">Message</td>
                        <td style="border:1px solid #dee2e6;line-height:1.7;">{!! nl2br(e($enquiry->message)) !!}</td>
                    </tr>

                </table>

            </td>
        </tr>

        <tr>
            <td style="background:#f8f9fa;padding:18px;text-align:center;font-size:13px;color:#666;">If you need
                immediate assistance, please contact us at our support number.</td>
        </tr>

    </table>

</body>

</html>
