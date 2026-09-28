<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Status Update - Olympia Education Career</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 24px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .header { background: #0b2545; padding: 32px 28px; text-align: left; }
        .brand-title { color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; }
        .body-content { padding: 32px 28px; }
        .status-badge { display: inline-block; background: #e0f2fe; color: #0369a1; padding: 8px 18px; border-radius: 9999px; font-weight: 700; font-size: 14px; margin: 12px 0; }
        .btn-track { display: inline-block; background: #0b2545; color: #ffffff !important; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; margin-top: 16px; }
        .footer { background: #f8fafc; padding: 24px 28px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1 class="brand-title">OLYMPIA EDUCATION CAREER</h1>
        </div>
        <div class="body-content">
            <h2 style="font-size: 18px; color: #0f172a; margin-top: 0;">Dear {{ $application->full_name }},</h2>
            <p>We are writing to inform you that there has been an update to your recruitment application for the position of <strong>{{ $application->jobVacancy?->title ?? 'Position' }}</strong> (Ref: <strong>{{ $application->reference_number }}</strong>).</p>

            <div style="background: #f8fafc; padding: 20px; border-radius: 8px; border: 1px solid #e2e8f0; margin: 20px 0;">
                <p style="margin: 0 0 6px; font-size: 13px; color: #64748b; text-transform: uppercase; font-weight: 600;">Updated Status</p>
                <div class="status-badge">{{ $application->status }}</div>
                @if($remarks)
                    <p style="margin: 12px 0 0; font-size: 14px; color: #334155; line-height: 1.5;"><strong>HR Note:</strong> {{ $remarks }}</p>
                @endif
            </div>

            <p>You can review detailed updates, next steps, and correspondence logs through your applicant tracking link below:</p>

            <p>
                <a href="{{ route('tracking.show', ['ref' => $application->reference_number, 'token' => $application->access_token]) }}" class="btn-track">View Complete Status Details</a>
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0 0 6px;">Olympia Education Malaysia &bull; Talent Acquisition</p>
            <p style="margin: 0;">This is an automated notification from the Olympia Education Career Portal prototype.</p>
        </div>
    </div>
</body>
</html>
