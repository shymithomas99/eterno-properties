<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Contact Enquiry</title>
</head>

<body style="margin:0;padding:20px;background:#f4f6f9;font-family:Arial,Helvetica,sans-serif;color:#333;">

    <table width="100%" cellpadding="0" cellspacing="0" border="0"
        style="max-width:700px;margin:0 auto;background:#ffffff;border-radius:8px;overflow:hidden;border:1px solid #e5e5e5;">

        <!-- Header -->
        <tr>
            <td style="background:#0d6efd;padding:20px;text-align:center;">
                <h2 style="margin:0;color:#ffffff;">
                    New Contact Enquiry
                </h2>
            </td>
        </tr>

        <!-- Intro -->
        <tr>
            <td style="padding:25px;">
                <p style="margin-top:0;font-size:15px;">
                    You have received a new enquiry through the website.
                </p>

                <table width="100%" cellpadding="10" cellspacing="0" border="0"
                    style="border-collapse:collapse;font-size:14px;">

                    <tr style="background:#f8f9fa;">
                        <td width="30%" style="font-weight:bold;border:1px solid #dee2e6;">
                            Name
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $enquiry->name }}
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;border:1px solid #dee2e6;">
                            Email
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $enquiry->email }}
                        </td>
                    </tr>

                    @if ($enquiry->phone)
                        <tr style="background:#f8f9fa;">
                            <td style="font-weight:bold;border:1px solid #dee2e6;">
                                Phone
                            </td>
                            <td style="border:1px solid #dee2e6;">
                                {{ $enquiry->phone }}
                            </td>
                        </tr>
                    @endif

                    @if ($enquiry->resort)
                        <tr>
                            <td style="font-weight:bold;border:1px solid #dee2e6;">
                                Interested Resort
                            </td>
                            <td style="border:1px solid #dee2e6;">
                                {{ $enquiry->resort }}
                            </td>
                        </tr>
                    @endif

                    <tr style="background:#f8f9fa;">
                        <td style="font-weight:bold;border:1px solid #dee2e6;vertical-align:top;">
                            Message
                        </td>
                        <td style="border:1px solid #dee2e6;line-height:1.7;">
                            {!! nl2br(e($enquiry->message)) !!}
                        </td>
                    </tr>

                    <tr>
                        <td style="font-weight:bold;border:1px solid #dee2e6;">
                            Submitted On
                        </td>
                        <td style="border:1px solid #dee2e6;">
                            {{ $enquiry->created_at->format('d M Y, h:i A') }}
                        </td>
                    </tr>

                </table>

            </td>
        </tr>

        <!-- Footer -->
        <tr>
            <td style="background:#f8f9fa;padding:18px;text-align:center;font-size:13px;color:#666;">
                This enquiry was submitted through the
                <strong>Eterno Hotels & Resorts</strong> website.
            </td>
        </tr>

    </table>

</body>

</html>
