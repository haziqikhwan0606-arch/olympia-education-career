<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->id();
            $table->foreignId('job_vacancy_id')->nullable()->constrained('job_vacancies')->nullOnDelete();
            $table->string('reference_number')->unique();
            $table->string('access_token', 64)->unique();

            // Personal Information
            $table->string('full_name');
            $table->string('email');
            $table->string('phone');
            $table->string('state'); // Malaysian state

            // Education
            $table->string('highest_education');
            $table->string('institution');
            $table->string('field_of_study');
            $table->string('graduation_year', 4);

            // Application Details
            $table->string('application_type'); // 'Full-Time', 'Internship', 'Part-Time', 'Contract'
            $table->text('relevant_experience')->nullable();
            $table->date('internship_start_date')->nullable();
            $table->date('internship_end_date')->nullable();
            $table->string('university_internship_duration')->nullable(); // e.g. '12 weeks', '6 months'

            // Documents (stored in private storage)
            $table->string('cv_path');
            $table->string('cv_original_name');
            $table->string('cover_letter_path')->nullable();
            $table->string('cover_letter_original_name')->nullable();

            // Statements & Consent
            $table->longText('interest_reason');
            $table->boolean('privacy_consent')->default(false);

            // Recruitment Progress
            $table->enum('status', [
                'Submitted',
                'Under Review',
                'Shortlisted',
                'Interview / Assessment',
                'Offered',
                'Rejected',
                'Withdrawn'
            ])->default('Submitted');
            $table->text('internal_notes')->nullable();
            $table->timestamp('status_updated_at')->nullable();

            $table->timestamps();
            $table->softDeletes();

            $table->index(['email', 'job_vacancy_id']);
            $table->index('reference_number');
            $table->index('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
