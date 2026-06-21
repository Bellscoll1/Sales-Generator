<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('campaigns', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->string('name');
            $table->string('type', 60);
            $table->string('status', 30)->default('draft');
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ended_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
        });

        Schema::create('campaign_steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('campaign_id')->index();
            $table->unsignedInteger('position');
            $table->string('action_type', 40);
            $table->json('action_payload')->nullable();
            $table->unsignedInteger('wait_minutes')->default(0);
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->cascadeOnDelete();
            $table->unique(['campaign_id', 'position']);
        });

        Schema::create('campaign_enrollments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('campaign_id')->index();
            $table->uuid('lead_id')->index();
            $table->string('status', 30)->default('active');
            $table->unsignedInteger('current_step')->default(0);
            $table->timestamp('next_run_at')->nullable();
            $table->timestamps();

            $table->foreign('campaign_id')->references('id')->on('campaigns')->cascadeOnDelete();
            $table->foreign('lead_id')->references('id')->on('leads')->cascadeOnDelete();
            $table->unique(['campaign_id', 'lead_id']);
        });

        Schema::create('conversations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('organization_id')->index();
            $table->uuid('lead_id')->nullable()->index();
            $table->uuid('assigned_to')->nullable()->index();
            $table->string('channel', 30)->default('linkedin');
            $table->string('status', 30)->default('open');
            $table->timestamp('last_message_at')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreign('lead_id')->references('id')->on('leads')->nullOnDelete();
            $table->foreign('assigned_to')->references('id')->on('users')->nullOnDelete();
        });

        Schema::create('messages', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('conversation_id')->index();
            $table->uuid('organization_id')->index();
            $table->uuid('sender_id')->nullable()->index();
            $table->enum('direction', ['inbound', 'outbound']);
            $table->longText('body');
            $table->timestamp('scheduled_for')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->json('meta')->nullable();
            $table->timestamps();

            $table->foreign('conversation_id')->references('id')->on('conversations')->cascadeOnDelete();
            $table->foreign('organization_id')->references('id')->on('organizations')->cascadeOnDelete();
            $table->foreign('sender_id')->references('id')->on('users')->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('messages');
        Schema::dropIfExists('conversations');
        Schema::dropIfExists('campaign_enrollments');
        Schema::dropIfExists('campaign_steps');
        Schema::dropIfExists('campaigns');
    }
};
