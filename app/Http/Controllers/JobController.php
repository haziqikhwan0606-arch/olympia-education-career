<?php

namespace App\Http\Controllers;

use App\Models\JobVacancy;
use Illuminate\Http\Request;
use Illuminate\View\View;

class JobController extends Controller
{
    public function index(Request $request): View
    {
        $query = JobVacancy::published();

        // Filters
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('description', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('type')) {
            $query->where('employment_type', $request->input('type'));
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        if ($request->filled('location')) {
            $query->where('location', 'like', '%' . $request->input('location') . '%');
        }

        if ($request->input('status') === 'closed') {
            $query->where(function ($q) {
                $q->where('status', 'closed')
                  ->orWhere(function ($sub) {
                      $sub->whereNotNull('closing_date')
                          ->where('closing_date', '<', now()->toDateString());
                  });
            });
        } elseif ($request->input('status') !== 'all') {
            // Default: show open vacancies
            $query->where('status', 'published')
                  ->where(function ($q) {
                      $q->whereNull('closing_date')
                        ->orWhere('closing_date', '>=', now()->toDateString());
                  });
        }

        // Sorting
        $sort = $request->input('sort', 'newest');
        if ($sort === 'closing_soon') {
            $query->orderByRaw('CASE WHEN closing_date IS NULL THEN 1 ELSE 0 END, closing_date ASC');
        } elseif ($sort === 'title') {
            $query->orderBy('title', 'asc');
        } else {
            $query->latest('published_at');
        }

        $vacancies = $query->paginate(9)->withQueryString();

        $departments = JobVacancy::published()->distinct()->pluck('department');
        $types = ['Full-Time', 'Internship', 'Part-Time', 'Contract'];
        $locations = ['Petaling Jaya, Selangor', 'Kuala Lumpur', 'Penang', 'Johor', 'Remote / Hybrid'];

        return view('pages.careers.index', compact('vacancies', 'departments', 'types', 'locations'));
    }

    public function internships(Request $request): View
    {
        $query = JobVacancy::published()
            ->where('employment_type', 'Internship');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%");
            });
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        // Show open by default
        $query->where(function ($q) {
            $q->whereNull('closing_date')
              ->orWhere('closing_date', '>=', now()->toDateString());
        })->latest('published_at');

        $internships = $query->paginate(8)->withQueryString();

        $departments = JobVacancy::published()
            ->where('employment_type', 'Internship')
            ->distinct()
            ->pluck('department');

        return view('pages.careers.internships', compact('internships', 'departments'));
    }

    public function show(string $slug): View
    {
        $vacancy = JobVacancy::where('slug', $slug)->firstOrFail();

        // Similar or related open opportunities
        $relatedJobs = JobVacancy::open()
            ->where('id', '!=', $vacancy->id)
            ->where(function ($q) use ($vacancy) {
                $q->where('department', $vacancy->department)
                  ->orWhere('employment_type', $vacancy->employment_type);
            })
            ->take(3)
            ->get();

        return view('pages.careers.show', compact('vacancy', 'relatedJobs'));
    }
}
