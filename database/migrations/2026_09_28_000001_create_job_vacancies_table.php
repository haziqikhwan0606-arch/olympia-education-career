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
        Schema::create('job_vacancies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('department');
            $table->string('employment_type'); // 'Full-Time', 'Part-Time', 'Internship', 'Contract'
            $table->string('location')->default('Petaling Jaya, Selangor');
            $table->text('summary')->nullable();
            $table->longText('description');
            $table->longText('responsibilities');
            $table->longText('qualifications');
            $table->longText('requirements')->nullable();
            $table->string('internship_duration')->nullable(); // e.g. '3 - 6 Months'
            $table->date('internship_start_date')->nullable();
            $table->string('salary_range')->nullable(); // e.g. 'RM 3,500 - RM 4,800' or 'RM 1,000 - RM 1,200 Allowance'
            $table->timestamp('published_at')->nullable();
            $table->date('closing_date')->nullable();
            $table->enum('status', ['draft', 'published', 'closed'])->default('draft');
            $table->boolean('is_featured')->default(false);
            $table->foreignId('created_by')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['status', 'published_at', 'closing_date']);
            $table->index('employment_type');
            $table->index('department');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('job_vacancies');
    }
};
