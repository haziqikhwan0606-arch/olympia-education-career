<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JobVacancy;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class AdminVacancyController extends Controller
{
    public function index(Request $request): View
    {
        $query = JobVacancy::withCount('applications');

        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('department', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        if ($request->filled('department')) {
            $query->where('department', $request->input('department'));
        }

        if ($request->filled('type')) {
            $query->where('employment_type', $request->input('type'));
        }

        $vacancies = $query->latest('created_at')->paginate(12)->withQueryString();

        $departments = JobVacancy::distinct()->pluck('department');

        return view('admin.vacancies.index', compact('vacancies', 'departments'));
    }

    public function create(): View
    {
        $departments = [
            'Academic Affairs',
            'Student Support & Services',
            'Information Technology',
            'Marketing & Communications',
            'Corporate Administration',
            'Finance & Accounting',
            'Human Resources',
        ];

        $types = ['Full-Time', 'Internship', 'Part-Time', 'Contract'];

        return view('admin.vacancies.create', compact('departments', 'types'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'department' => ['required', 'string', 'max:100'],
            'employment_type' => ['required', 'string', 'in:Full-Time,Internship,Part-Time,Contract'],
            'location' => ['required', 'string', 'max:150'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'responsibilities' => ['required', 'string'],
            'qualifications' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'internship_duration' => ['nullable', 'string', 'max:100'],
            'internship_start_date' => ['nullable', 'date'],
            'salary_range' => ['nullable', 'string', 'max:100'],
            'closing_date' => ['nullable', 'date', 'after_or_equal:today'],
            'status' => ['required', 'in:draft,published,closed'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $slug = Str::slug($validated['title']);
        $originalSlug = $slug;
        $counter = 1;
        while (JobVacancy::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $publishedAt = null;
        if ($validated['status'] === 'published') {
            $publishedAt = now();
        }

        $vacancy = JobVacancy::create([
            ...$validated,
            'slug' => $slug,
            'published_at' => $publishedAt,
            'is_featured' => $request->boolean('is_featured'),
            'created_by' => Auth::id(),
        ]);

        return redirect()->route('admin.vacancies.index')
            ->with('success', 'Vacancy "' . $vacancy->title . '" created successfully.');
    }

    public function edit(int $id): View
    {
        $vacancy = JobVacancy::findOrFail($id);

        $departments = [
            'Academic Affairs',
            'Student Support & Services',
            'Information Technology',
            'Marketing & Communications',
            'Corporate Administration',
            'Finance & Accounting',
            'Human Resources',
        ];

        $types = ['Full-Time', 'Internship', 'Part-Time', 'Contract'];

        return view('admin.vacancies.edit', compact('vacancy', 'departments', 'types'));
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $vacancy = JobVacancy::findOrFail($id);

        $validated = $request->validate([
            'title' => ['required', 'string', 'max:200'],
            'department' => ['required', 'string', 'max:100'],
            'employment_type' => ['required', 'string', 'in:Full-Time,Internship,Part-Time,Contract'],
            'location' => ['required', 'string', 'max:150'],
            'summary' => ['nullable', 'string', 'max:500'],
            'description' => ['required', 'string'],
            'responsibilities' => ['required', 'string'],
            'qualifications' => ['required', 'string'],
            'requirements' => ['nullable', 'string'],
            'internship_duration' => ['nullable', 'string', 'max:100'],
            'internship_start_date' => ['nullable', 'date'],
            'salary_range' => ['nullable', 'string', 'max:100'],
            'closing_date' => ['nullable', 'date'],
            'status' => ['required', 'in:draft,published,closed'],
            'is_featured' => ['nullable', 'boolean'],
        ]);

        $publishedAt = $vacancy->published_at;
        if ($validated['status'] === 'published' && !$vacancy->published_at) {
            $publishedAt = now();
        }

        $vacancy->update([
            ...$validated,
            'published_at' => $publishedAt,
            'is_featured' => $request->boolean('is_featured'),
        ]);

        return redirect()->route('admin.vacancies.index')
            ->with('success', 'Vacancy "' . $vacancy->title . '" updated successfully.');
    }

    public function toggleStatus(Request $request, int $id): RedirectResponse
    {
        $vacancy = JobVacancy::findOrFail($id);
        $newStatus = $request->input('status');

        if (!in_array($newStatus, ['draft', 'published', 'closed'])) {
            return back()->with('error', 'Invalid status selected.');
        }

        $vacancy->status = $newStatus;
        if ($newStatus === 'published' && !$vacancy->published_at) {
            $vacancy->published_at = now();
        }
        $vacancy->save();

        return back()->with('success', 'Vacancy status updated to ' . ucfirst($newStatus) . '.');
    }

    public function destroy(int $id): RedirectResponse
    {
        $vacancy = JobVacancy::findOrFail($id);
        $title = $vacancy->title;

        // Soft delete vacancy, preserving applications
        $vacancy->delete();

        return redirect()->route('admin.vacancies.index')
            ->with('success', 'Vacancy "' . $title . '" moved to archive. Candidate applications remain preserved.');
    }
}
