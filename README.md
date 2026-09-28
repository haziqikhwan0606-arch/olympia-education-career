# Olympia Education Career

> **Recruitment & Talent Management Portal for Olympia Education Malaysia**  
> *Standalone Prototype for Industry Supervisor & Corporate Management (Dato) Review*

---

## 1. Executive Summary & Purpose

**Olympia Education Career** is an independent, full-stack recruitment and talent acquisition web application engineered specifically for Olympia Education Malaysia. 

This platform serves as a modern digital recruitment hub where:
1. **Prospective Job Seekers & Undergraduates** can browse faculty vacancies, administrative roles, and university-accredited internships, submit comprehensive applications, and securely upload their Curriculum Vitae (CV) in PDF format.
2. **Candidates** can monitor their application progression in real-time using a confidential reference code without exposing sensitive internal evaluations.
3. **HR Personnel & Leadership** can manage active vacancies, screen candidate dossiers, download applicant resumes through secure authenticated routes, schedule panel interviews, record confidential notes, and maintain full audit accountability.

### Project Isolation Guarantee
* **Database:** Connects to an independent MySQL database named `olympia_career`.
* **Zero Disruption:** Operates completely separate from the corporate marketing site, official production databases, and Event Board implementations.
* **Demonstration Data:** Populated entirely with realistic, fictional sample data clearly labeled for demonstration.

---

## 2. Technology Stack

* **Backend:** Laravel 12 on PHP 8.2+ (PHP 8.4 compatible)
* **Database & ORM:** MySQL (`olympia_career`), Laravel Eloquent ORM with migrations, relationships, transactions, and seeders
* **Frontend:** Laravel Blade Templates, Tailwind CSS (v4), Alpine.js (reactive interactivity), Lucide Icons
* **Storage:** Laravel Local Disk with **Private Storage** isolation (`storage/app/private/cvs`), preventing public URL exposure
* **Security:** CSRF tokens, server-side MIME type verification, strict file size limits (5MB), role-based middleware (`EnsureHrAdmin`), rate limiting on submissions and logins

---

## 3. Demonstration Credentials

For testing and evaluation by the Industry Supervisor and Dato:

### HR Administration Portal (`/admin`)
* **URL:** `http://localhost:8000/admin` (or `http://localhost/olympia-education-career/public/admin`)
* **Administrator Email:** `admin@olympia.edu.my`
* **Administrator Password:** `OlympiaAdmin2026!`
* **Role:** HR Director / Administrator

### Pre-Seeded Candidate Tracking Codes (`/tracking`)
Use any of these combinations to verify the candidate tracking timeline:
* **Reference:** `OEC-2026-DEV001` | **Email:** `ahmad.daniel@example.com` *(Status: Shortlisted)*
* **Reference:** `OEC-2026-DEV002` | **Email:** `weilin.tan@example.com` *(Status: Interview / Assessment)*
* **Reference:** `OEC-2026-INT001` | **Email:** `nurul.izzah@example.com` *(Status: Under Review)*
* **Reference:** `OEC-2026-ADM001` | **Email:** `suresh.kumar@example.com` *(Status: Submitted)*
* **Reference:** `OEC-2026-MED001` | **Email:** `chloe.lim@example.com` *(Status: Offered)*

---

## 4. Installation & Local Setup

### Prerequisites
* PHP 8.2 or newer (`php -v`)
* Composer (`composer -v`)
* Node.js & npm (`node -v`, `npm -v`)
* MySQL / XAMPP MariaDB service running on port 3306

### Step-by-Step Setup

1. **Navigate to the Project Directory:**
   ```bash
   cd /Applications/XAMPP/xamppfiles/htdocs/olympia-education-career
   ```

2. **Verify Environment Configuration (`.env`):**
   Ensure database parameters point to `olympia_career`:
   ```ini
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=olympia_career
   DB_USERNAME=root
   DB_PASSWORD=
   DB_SOCKET=/Applications/XAMPP/xamppfiles/var/mysql/mysql.sock
   FILESYSTEM_DISK=local
   MAIL_MAILER=log
   ```

3. **Run Migrations & Demo Seeders:**
   ```bash
   php artisan migrate --force
   php artisan db:seed --force
   ```

4. **Build Frontend Assets:**
   ```bash
   npm run build
   ```

5. **Start Local Development Server:**
   ```bash
   php artisan serve
   ```
   The portal is accessible at `http://localhost:8000`.

---

## 5. System Architecture & Core Features

### A. Public Career Portal
* **Homepage (`/`):** Hero section with quick keyword search, active vacancy count chips, 4 career categories (Full-Time, Internship, Part-Time, Contract), featured job cards, Why Olympia themes, 5-step application roadmap, and footer navigation.
* **Vacancy Directory (`/careers`):** Search by keyword, multi-field filters (Department, Employment Type, Status), sort by Newest / Closing Soon / Title, pagination, closed status handling, and empty states.
* **Internships Gateway (`/internships`):** Dedicated student placement directory highlighting duration, allowance, expected intake date, and university endorsement prerequisites.
* **Job Detail (`/careers/{slug}`):** Full position overview, key responsibilities, prerequisites, closing dates, and direct "Apply Online" flow.

### B. Online Application System
* **Route:** `/careers/{slug}/apply`
* **Form Structure:**
  1. Personal Information (Full name, email, phone, Malaysian state)
  2. Academic Background (Highest qualification, institution, field of study, graduation year)
  3. Placement Specifics (Application type, experience summary, internship duration/dates)
  4. Documents Upload (CV/Resume PDF mandatory, Cover Letter PDF optional; max 5MB)
  5. Candidate Statement & Privacy Consent Checkbox
* **Security & Reliability:**
  * Files saved to private disk (`storage/app/private/cvs`), strictly non-public.
  * Form values preserved on validation error.
  * Duplicate submission prevention per email and job within 30 days.
  * Auto-generates unique reference code (`OEC-2026-XXXXX`) and secure access token.
  * Graceful email confirmation dispatch with fail-safe error logging.

### C. Candidate Application Tracking
* **Route:** `/tracking` & `/tracking/status`
* **Privacy Verification:** Requires both reference number and registered email to prevent sequential ID harvesting.
* **Visual Progress Timeline:** 5 sequential milestone stages (Submitted &rarr; Under Review &rarr; Shortlisted &rarr; Interview &rarr; Outcome).
* **Interview Notice Card:** When scheduled by HR, displays interview date, time, location format (video call/in-person), meeting link/venue, and panel instructions.
* **Confidentiality:** Internal HR notes and candidate evaluations are never exposed.

### D. HR Admin Portal
* **Route Group:** `/admin` (Protected by `EnsureHrAdmin` middleware)
* **Dashboard Overview (`/admin`):** Real-time database metrics (active vacancies, total candidates, pending reviews, shortlisted, scheduled interviews), recent applicants table, and departmental breakdown.
* **Vacancy Management (`/admin/vacancies`):** Full CRUD for vacancies, draft/published/closed state toggling, and soft deletion to safeguard candidate records.
* **Applicant Screening (`/admin/applicants`):** Search, filter by vacancy or status, review detailed candidate dossier, and **stream CVs securely** from private storage.
* **Status Updates & Audit Log:** Updates status to 'Shortlisted', 'Interview / Assessment', 'Offered', or 'Rejected', logs audit history with admin user attribution, and sends email notification.
* **Interview Scheduler:** Records panel members, datetime, venue, and automatically progresses candidate stage.
* **Confidential HR Notes:** Private notepad for interview impressions and compensation notes.

---

## 6. Automated Test Suite & Acceptance Results

Run the automated test suite at any time:
```bash
php artisan test --testdox
```

### Verified Test Cases
```
Hr Admin Workflow
 ✔ Unauthenticated user cannot access admin dashboard
 ✔ Unauthenticated user cannot download private cv
 ✔ Hr admin can login and access dashboard
 ✔ Hr admin can create vacancy
 ✔ Hr admin can update application status and audit history is recorded
 ✔ Hr admin can download candidate cv

Online Application
 ✔ Candidate can submit application with valid pdf cv
 ✔ Rejects non pdf file uploads
 ✔ Cannot apply for closed vacancy

Recruitment Public
 ✔ Homepage is accessible and renders featured vacancies
 ✔ Careers page can search and filter
 ✔ Internships page displays internships
 ✔ Job details page loads for valid slug
 ✔ Tracking page can be viewed

OK (16 tests, 48 assertions)
```

---

## 7. Deliverables & Presentation Notes

* **Prototype Status:** Fully functioning standalone recruitment prototype, presentation-ready for the Industry Supervisor and Dato.
* **Database Isolation:** Completely independent schema (`olympia_career`).
* **Design Aesthetic:** High-contrast Navy (`#0b2545`), white space, and warm orange accents (`#f97316`) consistent with corporate educational branding.
* **Demonstration Materials:** Includes seeded demo administrator and active sample candidates across diverse recruitment statuses.
