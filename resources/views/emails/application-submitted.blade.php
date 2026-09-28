<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Application Received - Olympia Education Career</title>
    <style>
        body { font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; background-color: #f8fafc; color: #1e293b; margin: 0; padding: 24px; }
        .wrapper { max-width: 600px; margin: 0 auto; background: #ffffff; border-radius: 12px; overflow: hidden; border: 1px solid #e2e8f0; }
        .header { background: #0b2545; padding: 32px 28px; text-align: left; }
        .brand-title { color: #ffffff; font-size: 20px; font-weight: 700; margin: 0; letter-spacing: -0.02em; }
        .brand-sub { color: #fdba74; font-size: 13px; font-weight: 500; margin-top: 4px; }
        .body-content { padding: 32px 28px; }
        .greeting { font-size: 18px; font-weight: 600; color: #0f172a; margin-top: 0; }
        .info-card { background: #f1f5f9; border-left: 4px solid #f97316; padding: 16px 20px; border-radius: 6px; margin: 24px 0; }
        .info-row { display: flex; justify-content: space-between; margin-bottom: 8px; font-size: 14px; }
        .info-label { color: #64748b; font-weight: 500; }
        .info-val { color: #0f172a; font-weight: 600; }
        .btn-track { display: inline-block; background: #0b2545; color: #ffffff !important; padding: 12px 28px; border-radius: 8px; font-weight: 600; text-decoration: none; font-size: 14px; margin-top: 16px; }
        .footer { background: #f8fafc; padding: 24px 28px; border-top: 1px solid #e2e8f0; font-size: 12px; color: #64748b; text-align: center; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1 class="brand-title">OLYMPIA EDUCATION CAREER</h1>
            <div class="brand-sub">Olympia Education Malaysia Recruitment Portal</div>
        </div>
        <div class="body-content">
            <h2 class="greeting">Dear {{ $application->full_name }},</h2>
            <p>Thank you for submitting your application to join Olympia Education Malaysia. We have successfully registered your application in our recruitment management system.</p>

            <div class="info-card">
                <div class="info-row">
                    <span class="info-label">Position Applied:</span>
                    <span class="info-val">{{ $application->jobVacancy?->title ?? 'General Application' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Application Reference:</span>
                    <span class="info-val" style="color: #ea580c; font-size: 15px;">{{ $application->reference_number }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Department:</span>
                    <span class="info-val">{{ $application->jobVacancy?->department ?? 'General' }}</span>
                </div>
                <div class="info-row">
                    <span class="info-label">Submission Date:</span>
                    <span class="info-val">{{ $application->created_at->format('d M Y, h:i A') }}</span>
                </div>
            </div>

            <h3 style="font-size: 15px; color: #0f172a; margin-top: 24px;">Next Steps in Our Selection Process:</h3>
            <ol style="font-size: 14px; line-height: 1.6; color: #475569; padding-left: 20px;">
                <li><strong>Application Screening:</strong> Our talent acquisition team reviews your qualifications, resume, and experience against position prerequisites.</li>
                <li><strong>Shortlisting:</strong> Suitable candidates will be invited for preliminary assessment or interview discussions.</li>
                <li><strong>Status Updates:</strong> You can track real-time progress of your application at any time using your reference number.</li>
            </ol>

            <p style="margin-top: 24px;">
                <a href="{{ route('tracking.show', ['ref' => $application->reference_number, 'token' => $application->access_token]) }}" class="btn-track">Check Application Status</a>
            </p>

            <p style="font-size: 13px; color: #64748b; margin-top: 24px;">
                <em>Please retain this email and your reference number (<strong>{{ $application->reference_number }}</strong>) for all future correspondence.</em>
            </p>
        </div>
        <div class="footer">
            <p style="margin: 0 0 6px;">Olympia Education Malaysia &bull; Talent Acquisition & People Management</p>
            <p style="margin: 0;">This is an automated notification from the Olympia Education Career Portal prototype.</p>
        </div>
    </div>
</body>
</html>
