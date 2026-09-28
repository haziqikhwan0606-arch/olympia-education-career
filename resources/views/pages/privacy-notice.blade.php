@extends('layouts.app')

@section('title', 'Applicant Privacy Notice | Olympia Education Career')
@section('meta_description', 'Information regarding personal data collection, processing, and candidate privacy on the Olympia Education Career portal.')

@section('content')
    <div class="bg-slate-900 text-white py-16 border-b border-slate-800">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 space-y-3">
            <span class="text-xs font-bold uppercase tracking-wider text-amber-400">Data Governance & Privacy</span>
            <h1 class="text-3xl sm:text-4xl font-extrabold text-white">
                Candidate Privacy Notice
            </h1>
            <p class="text-sm text-slate-300 leading-relaxed">
                Notice regarding personal data collection, handling, and candidate evaluation for applicants to Olympia Education Malaysia.
            </p>
        </div>
    </div>

    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-14 space-y-10">
        <!-- Prototype Notice -->
        <div class="p-4 rounded-2xl bg-amber-50 border border-amber-200 text-xs text-amber-900 flex items-start gap-3">
            <i data-lucide="shield-alert" class="w-5 h-5 text-amber-600 shrink-0 mt-0.5"></i>
            <div>
                <strong class="font-bold">Prototype Demonstration Statement:</strong>
                <p class="mt-0.5 leading-relaxed text-amber-950">
                    This privacy notice is provided as part of the Olympia Education Career prototype system. While built following stringent data security best practices (such as private storage and authenticated document delivery), this prototype is an evaluation deployment for management review and does not constitute formal legal certification.
                </p>
            </div>
        </div>

        <!-- 1. What Information We Collect -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
            <h2 class="text-xl font-bold text-slate-900">1. What Information We Collect</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                When you submit an employment or internship application through the Olympia Education Career portal, we collect the following categories of information:
            </p>
            <ul class="list-disc list-inside text-xs text-slate-600 space-y-1.5 pl-2 leading-relaxed">
                <li><strong>Personal Identity & Contact Data:</strong> Full legal name, email address, telephone/WhatsApp contact number, and Malaysian state or location.</li>
                <li><strong>Academic & Educational Background:</strong> Highest attained educational qualification, name of academic institution, field of study, and year of graduation.</li>
                <li><strong>Professional & Internship Data:</strong> Summary of relevant work experience, university internship placement duration requirements, and preferred commencement dates.</li>
                <li><strong>Application Documents:</strong> Digital Curriculum Vitae (CV) / resume and optional cover letter submitted in PDF format.</li>
                <li><strong>Candidate Statements:</strong> Responses to questions regarding your interest in joining Olympia Education Malaysia.</li>
            </ul>
            <p class="text-xs text-slate-500 pt-1">
                <em>We do NOT solicit or store national identity card (NRIC) numbers, passport numbers, bank account numbers, or candidate passwords through the public application portal.</em>
            </p>
        </section>

        <!-- 2. Why We Collect This Information -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
            <h2 class="text-xl font-bold text-slate-900">2. Why We Collect This Information (Purpose)</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                Your submitted data is collected strictly for legitimate recruitment and human resource planning purposes:
            </p>
            <ul class="list-disc list-inside text-xs text-slate-600 space-y-1.5 pl-2 leading-relaxed">
                <li>To assess your academic prerequisites and professional competencies against specific vacancy requirements.</li>
                <li>To communicate with you regarding application confirmations, shortlisting status, and interview scheduling.</li>
                <li>To enable you to track the progress of your application through the secure Candidate Tracking feature.</li>
                <li>To verify compliance with Malaysian educational and university internship placement regulations where applicable.</li>
            </ul>
        </section>

        <!-- 3. How Applications Are Reviewed & Stored -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
            <h2 class="text-xl font-bold text-slate-900">3. How Applications Are Reviewed & Stored</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                Applications are reviewed exclusively by authorized HR personnel and appointed departmental hiring managers. Candidate documents (CVs and cover letters) are kept in private local disk storage rather than publicly accessible directories. Access to document downloads is restricted by authenticated, session-protected routes with role-based authorization checks.
            </p>
            <p class="text-xs text-slate-600 leading-relaxed">
                Internal evaluations, interview notes, and reviewer remarks remain confidential to the HR department and are never disclosed on public tracking views or to other applicants.
            </p>
        </section>

        <!-- 4. Retention & Deletion Policy -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
            <h2 class="text-xl font-bold text-slate-900">4. Retention & Deletion Policy</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                Recruitment records and candidate files are retained in accordance with Olympia Education's approved institutional data retention policy or for a reasonable period following the conclusion of a recruitment exercise to facilitate future opportunity matching. Soft deletion and archival mechanisms ensure candidate records are not accidentally destroyed if a vacancy is closed.
            </p>
        </section>

        <!-- 5. Inquiries & Contact -->
        <section class="bg-white rounded-3xl border border-slate-200 p-8 shadow-2xs space-y-4">
            <h2 class="text-xl font-bold text-slate-900">5. Exercising Your Data Rights</h2>
            <p class="text-xs text-slate-600 leading-relaxed">
                If you have questions regarding your submitted personal data, wish to update your records, or request withdrawal and deletion of your application, please reach out to our Talent Acquisition team:
            </p>
            <div class="p-4 rounded-xl bg-slate-50 border border-slate-200 text-xs text-slate-700 space-y-1">
                <p><strong>Talent Acquisition & Data Coordinator:</strong></p>
                <p>Email: <code>careers-demo@olympia.edu.my</code> (Placeholder contact pending official designation)</p>
                <p>Olympia Education Malaysia &bull; Wisma Olympia / Petaling Jaya Campus, Selangor</p>
            </div>
        </section>
    </div>
@endsection
