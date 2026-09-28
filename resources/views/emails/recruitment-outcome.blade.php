<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recruitment Outcome - Olympia Education Career</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 24px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .header { background: #0b2545; padding: 32px 28px; text-align: left; }
        .brand-title { color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; }
        .body-content { padding: 32px 28px; }
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

            @if($outcomeType === 'offered')
                <div style="background: #ecfdf5; border-left: 4px solid #10b981; padding: 18px; border-radius: 6px; margin: 20px 0;">
                    <h3 style="color: #065f46; margin: 0 0 8px; font-size: 16px;">Formal Offer of Appointment / Placement</h3>
                    <p style="color: #047857; margin: 0; font-size: 14px; line-height: 1.5;">
                        We are thrilled to offer you the position of <strong>{{ $application->jobVacancy?->title ?? 'Position' }}</strong> at Olympia Education Malaysia!
                    </p>
                </div>
                <p>The recruitment committee was deeply impressed by your credentials, domain enthusiasm, and interview performance. Our HR operations team will be sending you formal paperwork, onboarding details, and appointment documentation shortly.</p>
                @if($remarks)
                    <p style="background: #f8fafc; padding: 14px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;"><strong>Special Note:</strong> {{ $remarks }}</p>
                @endif
            @else
                <p>Thank you for taking the time to participate in our recruitment exercise for the position of <strong>{{ $application->jobVacancy?->title ?? 'Position' }}</strong> (Ref: <strong>{{ $application->reference_number }}</strong>).</p>
                <p>While your background is commendable, after thorough evaluation of all applications against our present operational prerequisites, we have decided to progress with other candidates whose profiles more closely align with the immediate requirements of this role.</p>
                <p>We truly appreciate your interest in building your career with Olympia Education, and we warmly invite you to monitor future openings on our careers portal.</p>
                @if($remarks)
                    <p style="background: #f8fafc; padding: 14px; border-radius: 6px; border: 1px solid #e2e8f0; font-size: 14px;"><strong>Feedback:</strong> {{ $remarks }}</p>
                @endif
            @endif

            <p style="margin-top: 24px;">
                <a href="{{ route('tracking.show', ['ref' => $application->reference_number, 'token' => $application->access_token]) }}" style="display: inline-block; background: #0b2545; color: #ffffff !important; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px;">Review Application Status</a>
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0 0 6px;">Olympia Education Malaysia &bull; Talent Acquisition</p>
            <p style="margin: 0;">This is an automated notification from the Olympia Education Career Portal prototype.</p>
        </div>
    </div>
</body>
</html>
