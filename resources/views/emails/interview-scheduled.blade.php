<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interview Invitation - Olympia Education Career</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 24px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .header { background: #0b2545; padding: 32px 28px; text-align: left; }
        .brand-title { color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; }
        .body-content { padding: 32px 28px; }
        .details-box { background: #fdf2f8; border: 1px solid #fbcfe8; border-radius: 8px; padding: 20px; margin: 20px 0; }
        .details-item { margin-bottom: 10px; font-size: 14px; }
        .footer { background: #f8fafc; padding: 24px 28px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1 class="brand-title">OLYMPIA EDUCATION CAREER</h1>
            <div style="color: #f472b6; font-size: 13px; font-weight: 600; margin-top: 4px;">Recruitment Interview Invitation</div>
        </div>
        <div class="body-content">
            <h2 style="font-size: 18px; color: #0f172a; margin-top: 0;">Dear {{ $application->full_name }},</h2>
            <p>Congratulations! Following review of your application for <strong>{{ $application->jobVacancy?->title ?? 'Position' }}</strong> (Ref: <strong>{{ $application->reference_number }}</strong>), we would like to invite you for an interview session with our selection committee.</p>

            <div class="details-box">
                <div class="details-item"><strong>Date & Time:</strong> {{ $interview->scheduled_at->format('l, d F Y - h:i A') }} (MYT)</div>
                <div class="details-item"><strong>Session Format:</strong> {{ $interview->location_type }}</div>
                <div class="details-item"><strong>Venue / Meeting Link:</strong> <a href="{{ $interview->meeting_link_or_venue }}">{{ $interview->meeting_link_or_venue }}</a></div>
                <div class="details-item"><strong>Interview Panel:</strong> {{ $interview->interviewer_names }}</div>
                @if($interview->notes)
                    <div class="details-item" style="margin-top: 12px; padding-top: 8px; border-top: 1px dashed #f472b6;">
                        <strong>Instructions / Preparation:</strong><br>
                        {{ $interview->notes }}
                    </div>
                @endif
            </div>

            <p style="font-size: 14px; color: #475569;">Please ensure you are prepared with a valid identity document and digital copies of your academic transcripts or portfolio where applicable. If you require rescheduling, kindly reply to this notification as soon as possible.</p>

            <p style="margin-top: 24px;">
                <a href="{{ route('tracking.show', ['ref' => $application->reference_number, 'token' => $application->access_token]) }}" style="display: inline-block; background: #0b2545; color: #ffffff !important; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px;">Confirm / View Tracking</a>
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0 0 6px;">Olympia Education Malaysia &bull; Talent Acquisition</p>
            <p style="margin: 0;">This is an automated notification from the Olympia Education Career Portal prototype.</p>
        </div>
    </div>
</body>
</html>
