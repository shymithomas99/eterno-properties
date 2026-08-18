<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You for Contacting Us</title>
</head>

<body style="margin:0;padding:20px;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="max-width:700px;margin:0 auto;background:#ffffff;border:1px solid #e5e5e5;border-radius:8px;overflow:hidden;">

        <!-- Header -->
        <tr>
            <td style="background:#0d6efd;padding:25px;text-align:center;">
                <h2 style="margin:0;color:#ffffff;font-weight:600;">
                    Thank You for Contacting Us
                </h2>
            </td>
        </tr>

        <!-- Content -->
        <tr>
            <td style="padding:30px;">

                <p style="margin-top:0;font-size:15px;">
                    Dear <strong>{{ $enquiry->name }}</strong>,
                </p>

                <p style="font-size:15px;line-height:1.8;margin-bottom:20px;">
                    Thank you for contacting <strong>Eterno Hotels & Resorts</strong>.
                    We have successfully received your enquiry and truly appreciate your interest in our resorts.
                </p>

                <p style="font-size:15px;line-height:1.8;">
                    Our team is reviewing your request and will get back to you as soon as possible with the information
                    you need.
                </p>

                <table width="100%" cellpadding="10" cellspacing="0" border="0"
                    style="margin-top:30px;border-collapse:collapse;font-size:14px;">

                    <tr style="background:#f8f9fa;">
                        <td width="30%" style="font-weight:bold;border:1px solid #dee2e6;">
                            Interested Resort
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $enquiry->resort }}
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;border:1px solid #dee2e6;vertical-align:top;">
                            Your Message
                        </td>
                        <td style="border:1px solid #dee2e6;line-height:1.7;">
                            {!! nl2br(e($enquiry->message)) !!}
                        </td>
                    </tr>

                    <tr style="background:#f8f9fa;">
                        <td style="font-weight:bold;border:1px solid #dee2e6;">
                            Submitted On
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $enquiry->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>

                </table>

                <p style="margin-top:30px;font-size:15px;line-height:1.8;">
                    If your enquiry is urgent, please feel free to contact us directly and our team will be happy to
                    assist you.
                </p>

                <p style="margin-top:30px;font-size:15px;">
                    Kind Regards,<br>
                    <strong>Eterno Hotels & Resorts</strong>
                </p>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f8f9fa;padding:20px;text-align:center;font-size:13px;color:#666;line-height:1.6;">
                This is an automated acknowledgement email confirming that we have received your enquiry.<br>
                Our team will respond to you shortly.
            </td>
        </tr>

    </table>

</body>

</html>
