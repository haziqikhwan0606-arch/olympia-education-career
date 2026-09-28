<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Application;
use App\Models\Interview;
use App\Models\JobVacancy;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        // Real database metrics
        $totalActiveVacancies = JobVacancy::open()->count();
        $totalVacancies = JobVacancy::count();
        $totalApplications = Application::count();
        $awaitingReviewCount = Application::where('status', 'Submitted')->count();
        $underReviewCount = Application::where('status', 'Under Review')->count();
        $shortlistedCount = Application::where('status', 'Shortlisted')->count();
        $interviewStageCount = Application::where('status', 'Interview / Assessment')->count();
        $offeredCount = Application::where('status', 'Offered')->count();

        // Upcoming interviews
        $upcomingInterviews = Interview::with(['application.jobVacancy', 'interviewer'])
            ->where('scheduled_at', '>=', now()->subHours(2))
            ->where('status', 'Scheduled')
            ->orderBy('scheduled_at', 'asc')
            ->take(5)
            ->get();

        // Recent applications
        $recentApplications = Application::with('jobVacancy')
            ->latest('created_at')
            ->take(8)
            ->get();

        // Vacancy distribution by department
        $departmentStats = JobVacancy::select('department', DB::raw('count(*) as total'))
            ->groupBy('department')
            ->orderByDesc('total')
            ->get();

        // Application status distribution
        $statusDistribution = Application::select('status', DB::raw('count(*) as count'))
            ->groupBy('status')
            ->pluck('count', 'status')
            ->toArray();

        return view('admin.dashboard', compact(
            'totalActiveVacancies',
            'totalVacancies',
            'totalApplications',
            'awaitingReviewCount',
            'underReviewCount',
            'shortlistedCount',
            'interviewStageCount',
            'offeredCount',
            'upcomingInterviews',
            'recentApplications',
            'departmentStats',
            'statusDistribution'
        ));
    }
}
