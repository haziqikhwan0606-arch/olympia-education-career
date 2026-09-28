<?php

use App\Http\Controllers\Admin\AdminApplicantController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminVacancyController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\StaticPageController;
use App\Http\Controllers\TrackingController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public Recruitment Portal Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/careers', [JobController::class, 'index'])->name('careers.index');
Route::get('/internships', [JobController::class, 'internships'])->name('internships');
Route::redirect('/careers/internships', '/internships');
Route::get('/careers/{slug}', [JobController::class, 'show'])->name('careers.show');

// Online Application System
Route::get('/careers/{slug}/apply', [ApplicationController::class, 'create'])->name('applications.create');
Route::post('/careers/{slug}/apply', [ApplicationController::class, 'store'])
    ->middleware('throttle:15,1')
    ->name('applications.store');
Route::get('/applications/confirmation', [ApplicationController::class, 'success'])->name('applications.success');

// Candidate Application Tracking
Route::get('/tracking', [TrackingController::class, 'index'])->name('tracking.index');
Route::post('/tracking/check', [TrackingController::class, 'check'])
    ->middleware('throttle:20,1')
    ->name('tracking.check');
Route::get('/tracking/status', [TrackingController::class, 'show'])->name('tracking.show');
Route::post('/tracking/withdraw', [TrackingController::class, 'withdraw'])->name('tracking.withdraw');

// Static & Information Pages
Route::get('/about', [StaticPageController::class, 'about'])->name('about');
Route::get('/contact', [StaticPageController::class, 'contact'])->name('contact');
Route::get('/privacy-notice', [StaticPageController::class, 'privacyNotice'])->name('privacy.notice');

/*
|--------------------------------------------------------------------------
| HR Administration Portal Routes
|--------------------------------------------------------------------------
*/

Route::prefix('admin')->group(function () {
    // Auth routes
    Route::get('/login', [AdminAuthController::class, 'login'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'authenticate'])
        ->middleware('throttle:10,1')
        ->name('admin.authenticate');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');

    // Protected HR Admin Routes
    Route::middleware(['auth', 'hr_admin'])->group(function () {
        Route::get('/', [AdminDashboardController::class, 'index'])->name('admin.dashboard');

        // Vacancy Management
        Route::get('/vacancies', [AdminVacancyController::class, 'index'])->name('admin.vacancies.index');
        Route::get('/vacancies/create', [AdminVacancyController::class, 'create'])->name('admin.vacancies.create');
        Route::post('/vacancies', [AdminVacancyController::class, 'store'])->name('admin.vacancies.store');
        Route::get('/vacancies/{id}/edit', [AdminVacancyController::class, 'edit'])->name('admin.vacancies.edit');
        Route::put('/vacancies/{id}', [AdminVacancyController::class, 'update'])->name('admin.vacancies.update');
        Route::patch('/vacancies/{id}/status', [AdminVacancyController::class, 'toggleStatus'])->name('admin.vacancies.status');
        Route::delete('/vacancies/{id}', [AdminVacancyController::class, 'destroy'])->name('admin.vacancies.destroy');

        // Applicant Management
        Route::get('/applicants', [AdminApplicantController::class, 'index'])->name('admin.applicants.index');
        Route::get('/applicants/{id}', [AdminApplicantController::class, 'show'])->name('admin.applicants.show');
        Route::get('/applicants/{id}/cv', [AdminApplicantController::class, 'downloadCv'])->name('admin.applicants.download_cv');
        Route::get('/applicants/{id}/cover-letter', [AdminApplicantController::class, 'downloadCoverLetter'])->name('admin.applicants.download_cover_letter');
        Route::patch('/applicants/{id}/status', [AdminApplicantController::class, 'updateStatus'])->name('admin.applicants.update_status');
        Route::patch('/applicants/{id}/notes', [AdminApplicantController::class, 'updateNotes'])->name('admin.applicants.update_notes');
        Route::post('/applicants/{id}/interview', [AdminApplicantController::class, 'scheduleInterview'])->name('admin.applicants.schedule_interview');
    });
});
