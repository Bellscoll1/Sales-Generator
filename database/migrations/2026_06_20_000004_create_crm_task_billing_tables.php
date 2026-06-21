<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pipelines', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->string('name');
            $table->boolean('is_default')->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
        });

        Schema::create('pipeline_stages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('pipeline_id')->index();
            $table->string('name');
            $table->unsignedInteger('position');
            $table->unsignedTinyInteger('default_probability')->default(10);
            $table->timestamps();

            $table->foreign('pipeline_id')->references('id')->on('pipelines')->cascadeOnDelete();
            $table->unique(['pipeline_id', 'position']);
        });

        Schema::create('deals', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->uuid('pipeline_stage_id')->nullable()->index();
            $table->string('name');
            $table->decimal('value', 14, 2)->default(0);
            $table->uuid('owner_id')->nullable()->index();
            $table->unsignedTinyInteger('probability')->default(10);
            $table->date('close_date')->nullable();
            $table->string('stage', 40)->default('lead');
            $table->text('notes')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreign('pipeline_stage_id')->references('id')->on('pipeline_stages')->nullOnDelete();
            $table->foreign('owner_id')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('tasks', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->string('title');
            $table->string('type', 50);
            $table->string('status', 40)->default('open');
            $table->uuid('assigned_to')->nullable()->index();
            $table->timestamp('due_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('plans', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('slug')->unique();
            $table->decimal('monthly_price', 10, 2);
            $table->decimal('annual_price', 10, 2);
            $table->unsignedInteger('seat_limit')->nullable();
            $table->json('features')->nullable();
            $table->timestamps();
        });

        Schema::create('subscriptions', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->uuid('plan_id')->index();
            $table->string('provider', 20)->default('stripe');
            $table->string('provider_subscription_id')->nullable()->index();
            $table->string('status', 30)->default('trialing');
            $table->unsignedInteger('seat_count')->default(1);
            $table->timestamp('trial_ends_at')->nullable();
            $table->timestamp('current_period_ends_at')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreign('plan_id')->references('id')->on('plans')->restrictOnDelete();
        });

        Schema::create('invoices', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('subscription_id')->index();
            $table->string('number')->unique();
            $table->decimal('subtotal', 12, 2)->default(0);
            $table->decimal('tax', 12, 2)->default(0);
            $table->decimal('total', 12, 2)->default(0);
            $table->string('currency', 3)->default('USD');
            $table->string('status', 30)->default('draft');
            $table->timestamp('issued_at')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamps();

            $table->foreign('subscription_id')->references('id')->on('subscriptions')->cascadeOnDelete();
        });

        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->nullable()->index();
            $table->uuid('user_id')->nullable()->index();
            $table->string('action', 120);
            $table->string('entity_type', 120)->nullable();
            $table->uuid('entity_id')->nullable();
            $table->json('changes')->nullable();
            $table->ipAddress('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamps();

            $table->foreign('organization_id')->references('id')->on('organizations')->nullOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('audit_logs');
        Schema::dropIfExists('invoices');
        Schema::dropIfExists('subscriptions');
        Schema::dropIfExists('plans');
        Schema::dropIfExists('tasks');
        Schema::dropIfExists('deals');
        Schema::dropIfExists('pipeline_stages');
        Schema::dropIfExists('pipelines');
    }
};
