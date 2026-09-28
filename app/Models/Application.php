<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Application extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'job_vacancy_id',
        'reference_number',
        'access_token',
        'full_name',
        'email',
        'phone',
        'state',
        'highest_education',
        'institution',
        'field_of_study',
        'graduation_year',
        'application_type',
        'relevant_experience',
        'internship_start_date',
        'internship_end_date',
        'university_internship_duration',
        'cv_path',
        'cv_original_name',
        'cover_letter_path',
        'cover_letter_original_name',
        'interest_reason',
        'privacy_consent',
        'status',
        'internal_notes',
        'status_updated_at',
    ];

    protected function casts(): array
    {
        return [
            'internship_start_date' => 'date',
            'internship_end_date' => 'date',
            'privacy_consent' => 'boolean',
            'status_updated_at' => 'datetime',
        ];
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($app) {
            if (empty($app->reference_number)) {
                $app->reference_number = 'OEC-' . date('Y') . '-' . strtoupper(Str::random(6));
            }
            if (empty($app->access_token)) {
                $app->access_token = Str::random(40);
            }
            if (empty($app->status_updated_at)) {
                $app->status_updated_at = now();
            }
        });
    }

    public function jobVacancy(): BelongsTo
    {
        return $this->belongsTo(JobVacancy::class, 'job_vacancy_id');
    }

    public function statusHistories(): HasMany
    {
        return $this->hasMany(ApplicationStatusHistory::class, 'application_id')->latest();
    }

    public function interviews(): HasMany
    {
        return $this->hasMany(Interview::class, 'application_id')->orderBy('scheduled_at', 'asc');
    }

    public function latestInterview(): HasOne
    {
        return $this->hasOne(Interview::class, 'application_id')->latestOfMany();
    }

    public function getStatusBadgeClassAttribute(): string
    {
        return match ($this->status) {
            'Submitted' => 'bg-blue-50 text-blue-700 border-blue-200',
            'Under Review' => 'bg-amber-50 text-amber-700 border-amber-200',
            'Shortlisted' => 'bg-indigo-50 text-indigo-700 border-indigo-200',
            'Interview / Assessment' => 'bg-purple-50 text-purple-700 border-purple-200',
            'Offered' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
            'Rejected' => 'bg-rose-50 text-rose-700 border-rose-200',
            'Withdrawn' => 'bg-slate-100 text-slate-600 border-slate-200',
            default => 'bg-slate-50 text-slate-700 border-slate-200',
        };
    }
}
