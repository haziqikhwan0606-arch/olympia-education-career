<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $featuredJobs = JobVacancy::open()
            ->featured()
            ->latest('published_at')
            ->take(6)
            ->get();

        // If not enough featured, take latest open
        if ($featuredJobs->count() < 4) {
            $featuredJobs = JobVacancy::open()
                ->latest('published_at')
                ->take(6)
                ->get();
        }

        $typeCounts = [
            'Full-Time' => JobVacancy::open()->where('employment_type', 'Full-Time')->count(),
            'Internship' => JobVacancy::open()->where('employment_type', 'Internship')->count(),
            'Part-Time' => JobVacancy::open()->where('employment_type', 'Part-Time')->count(),
            'Contract' => JobVacancy::open()->where('employment_type', 'Contract')->count(),
        ];

        $departments = JobVacancy::open()
            ->select('department')
            ->distinct()
            ->pluck('department');

        return view('pages.home', compact('featuredJobs', 'typeCounts', 'departments'));
    }
}
