<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $concert['name'] }} Registration Confirmed</title>
</head>
<body style="margin: 0; padding: 0; background-color: #09070e; color: #f5efff; font-family: Arial, Helvetica, sans-serif;">
    <div style="display: none; max-height: 0; overflow: hidden; opacity: 0;">
        Your {{ $concert['name'] }} registration is confirmed. Save your ticket and event details.
    </div>
    <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="background-color: #09070e; padding: 32px 12px;">
        <tr>
            <td align="center">
                <table role="presentation" width="600" cellspacing="0" cellpadding="0" border="0" style="width: 100%; max-width: 600px; border: 1px solid #30243f; border-radius: 16px; overflow: hidden; background-color: #120e1a;">
                    <tr>
                        <td style="padding: 32px 36px; background-color: #211331; background-image: linear-gradient(135deg, #28143d, #100c18);">
                            <p style="margin: 0; color: #d5b2ff; font-size: 12px; font-weight: bold; letter-spacing: 3px;">NIGHTWAVE / LIVE</p>
                            <h1 style="margin: 18px 0 8px; color: #ffffff; font-family: Georgia, 'Times New Roman', serif; font-size: 38px; font-weight: normal;">You're on the list.</h1>
                            <p style="margin: 0; color: #d6c9e6; font-size: 15px; line-height: 1.6;">Your ticket registration has been confirmed.</p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 30px 36px;">
                            <p style="margin: 0 0 12px; color: #f5efff; font-size: 16px;">Hello, <strong>{{ $registration->name }}</strong>!</p>
                            <p style="margin: 0 0 24px; color: #b9aec8; font-size: 14px; line-height: 1.7;">
                                Thank you for choosing <strong style="color: #d5b2ff;">{{ $concert['name'] }}</strong>. Keep this email as your registration confirmation.
                            </p>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="border: 1px solid #352841; border-radius: 12px; background-color: #191322;">
                                <tr>
                                    <td style="padding: 20px 22px 8px;">
                                        <p style="margin: 0 0 6px; color: #9c8eac; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase;">Your tickets</p>
                                        <p style="margin: 0; color: #f5efff; font-size: 18px; font-weight: bold;">
                                            {{ $registration->ticket_type === 'vip' ? 'VIP' : 'Regular' }} <span style="color: #c18bff;">· {{ $registration->quantity }} {{ $registration->quantity === 1 ? 'ticket' : 'tickets' }}</span>
                                        </p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 22px 8px;">
                                        <p style="margin: 0 0 6px; color: #9c8eac; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase;">Event schedule</p>
                                        <p style="margin: 0; color: #f5efff; font-size: 15px; font-weight: bold;">{{ $concert['date'] }}</p>
                                        <p style="margin: 5px 0 0; color: #b9aec8; font-size: 13px;">{{ $concert['location'] }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 14px 22px 20px;">
                                        <p style="margin: 0 0 6px; color: #9c8eac; font-size: 11px; letter-spacing: 1.5px; text-transform: uppercase;">Registration reference</p>
                                        <p style="margin: 0; color: #d5b2ff; font-size: 15px; font-weight: bold; letter-spacing: 1px;">{{ $registration->reference }}</p>
                                    </td>
                                </tr>
                            </table>

                            <table role="presentation" width="100%" cellspacing="0" cellpadding="0" border="0" style="margin-top: 18px;">
                                <tr>
                                    <td style="padding: 0 0 8px; color: #b9aec8; font-size: 13px;">Price per ticket</td>
                                    <td align="right" style="padding: 0 0 8px; color: #f5efff; font-size: 13px;">IDR {{ number_format($registration->unit_price, 0, '.', ',') }}</td>
                                </tr>
                                <tr>
                                    <td style="padding: 12px 0 0; border-top: 1px solid #352841; color: #f5efff; font-size: 14px; font-weight: bold;">Order total</td>
                                    <td align="right" style="padding: 12px 0 0; border-top: 1px solid #352841; color: #d5b2ff; font-size: 18px; font-weight: bold;">IDR {{ number_format($registration->total_price, 0, '.', ',') }}</td>
                                </tr>
                            </table>

                            <p style="margin: 24px 0 0; color: #9c8eac; font-size: 12px; line-height: 1.6;">This email confirms your registration and is not proof of payment. We look forward to seeing you for an unforgettable night of music.</p>
                        </td>
                    </tr>
                    <tr>
                        <td align="center" style="padding: 18px 24px; border-top: 1px solid #30243f; color: #81748e; font-size: 11px; letter-spacing: 1px;">
                            NIGHTWAVE · A NIGHT TO REMEMBER
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
