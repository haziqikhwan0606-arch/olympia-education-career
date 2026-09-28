<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class JobVacancy extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'job_vacancies';

    protected $fillable = [
        'title',
        'slug',
        'department',
        'employment_type',
        'location',
        'summary',
        'description',
        'responsibilities',
        'qualifications',
        'requirements',
        'internship_duration',
        'internship_start_date',
        'salary_range',
        'published_at',
        'closing_date',
        'status',
        'is_featured',
        'created_by',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'closing_date' => 'date',
            'internship_start_date' => 'date',
            'is_featured' => 'boolean',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($job) {
            if (empty($job->slug)) {
                $job->slug = Str::slug($job->title) . '-' . Str::lower(Str::random(5));
            }
        });
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function applications(): HasMany
    {
        return $this->hasMany(Application::class, 'job_vacancy_id');
    }

    public function isOpen(): bool
    {
        if ($this->status !== 'published') {
            return false;
        }

        if ($this->closing_date && $this->closing_date->endOfDay()->isPast()) {
            return false;
        }

        return true;
    }

    public function getDaysLeftAttribute(): ?int
    {
        if (!$this->closing_date) {
            return null;
        }

        $diff = (int) now()->startOfDay()->diffInDays($this->closing_date->startOfDay(), false);
        return $diff;
    }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published');
    }

    public function scopeOpen(Builder $query): Builder
    {
        return $query->where('status', 'published')
            ->where(function ($q) {
                $q->whereNull('closing_date')
                    ->orWhere('closing_date', '>=', now()->toDateString());
            });
    }

    public function scopeFeatured(Builder $query): Builder
    {
        return $query->where('is_featured', true);
    }

    public function scopeFilter(Builder $query, array $filters): Builder
    {
        return $query
            ->when($filters['search'] ?? null, function ($q, $search) {
                $q->where(function ($sub) use ($search) {
                    $sub->where('title', 'like', "%{$search}%")
                        ->orWhere('department', 'like', "%{$search}%")
                        ->orWhere('location', 'like', "%{$search}%")
                        ->orWhere('summary', 'like', "%{$search}%")
                        ->orWhere('description', 'like', "%{$search}%");
                });
            })
            ->when($filters['type'] ?? null, function ($q, $type) {
                $q->where('employment_type', $type);
            })
            ->when($filters['department'] ?? null, function ($q, $dept) {
                $q->where('department', $dept);
            })
            ->when($filters['location'] ?? null, function ($q, $loc) {
                $q->where('location', 'like', "%{$loc}%");
            });
    }
}
