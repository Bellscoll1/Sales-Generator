<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->string('profile_image')->nullable();
            $table->string('headline')->nullable();
            $table->string('job_title')->nullable();
            $table->string('company')->nullable();
            $table->string('industry')->nullable();
            $table->string('location')->nullable();
            $table->string('email')->nullable()->index();
            $table->string('phone')->nullable();
            $table->string('website')->nullable();
            $table->unsignedInteger('employee_count')->nullable();
            $table->decimal('revenue', 14, 2)->nullable();
            $table->unsignedTinyInteger('lead_score')->default(0);
            $table->string('status', 40)->default('new')->index();
            $table->string('source', 80)->default('manual')->index();
            $table->text('notes')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->unique(['organization_id', 'linkedin_url']);
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->string('name');
            $table->string('color', 20)->default('blue');
            $table->timestamps();
            $table->softDeletes();

            $table->unique(['organization_id', 'name']);
            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
        });

        Schema::create('lead_tag', function (Blueprint $table) {
            $table->uuid('lead_id');
            $table->uuid('tag_id');
            $table->primary(['lead_id', 'tag_id']);
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();
        });

        Schema::create('lead_status_history', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('lead_id')->index();
            $table->string('from_status', 40)->nullable();
            $table->string('to_status', 40);
            $table->uuid('changed_by')->nullable();
            $table->timestamps();

            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->foreign('changed_by')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lead_status_history');
        Schema::dropIfExists('lead_tag');
        Schema::dropIfExists('tags');
        Schema::dropIfExists('leads');
    }
};
