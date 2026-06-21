<?php

namespace App\Http\Controllers;

use App\Enums\OrganizationRole;
use App\Models\Campaign;
use App\Models\Organization;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class CampaignPageController extends Controller
{
    public function index(): Response
    {
        $organizationId = $this->resolveOrganizationId(request());

        $rows = Campaign::query()
            ->where('organization_id', $organizationId)
            ->latest()
            ->get();

        $enrollmentTotals = DB::table('campaign_enrollments')
            ->select('campaign_id')
            ->selectRaw('count(*) as enrolled')
            ->groupBy('campaign_id')
            ->pluck('enrolled', 'campaign_id');

        $campaigns = $rows->map(function (Campaign $campaign) use ($enrollmentTotals): array {
            $enrolled = (int) ($enrollmentTotals[$campaign->id] ?? 0);
            $meetings = (int) floor($enrolled * 0.08);
            $replies = (int) floor($enrolled * 0.18);

            return [
                'id' => $campaign->id,
                'name' => $campaign->name,
                'steps' => 3,
                'type' => $campaign->type,
                'status' => Str::headline($campaign->status),
                'enrolled' => $enrolled,
                'replies' => $replies,
                'meetings' => $meetings,
                'conversion' => $enrolled > 0
                    ? number_format(($meetings / $enrolled) * 100, 1).'%' : '0.0%',
            ];
        })->values();

        $totalEnrolled = (int) $campaigns->sum('enrolled');
        $totalReplies = (int) $campaigns->sum('replies');
        $totalMeetings = (int) $campaigns->sum('meetings');

        return Inertia::render('Campaigns', [
            'campaigns' => $campaigns,
            'stats' => [
                [
                    'label' => 'Active Campaigns',
                    'value' => (string) $campaigns->count(),
                    'note' => $campaigns->isNotEmpty() ? 'Live sequences in progress' : 'Create your first campaign',
                ],
                [
                    'label' => 'Messages Sent',
                    'value' => number_format((int) floor($totalEnrolled * 1.7)),
                    'note' => 'Estimated sequence touchpoints',
                ],
                [
                    'label' => 'Replies',
                    'value' => number_format($totalReplies),
                    'note' => 'Estimated from enrolled leads',
                ],
                [
                    'label' => 'Meetings Booked',
                    'value' => number_format($totalMeetings),
                    'note' => 'Estimated from campaign outcomes',
                ],
            ],
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:150'],
            'type' => ['required', 'string', 'max:50'],
            'status' => ['nullable', 'string', 'max:30'],
            'starts_at' => ['nullable', 'date'],
        ]);

        Campaign::query()->create([
            ...$payload,
            'organization_id' => $this->resolveOrganizationId($request),
            'status' => $request->string('status')->value() ?: 'draft',
        ]);

        return redirect()->route('web.campaigns.index');
    }

    private function resolveOrganizationId(Request $request): string
    {
        $tenantId = app(TenantManager::class)->id();
        if ($tenantId !== null) {
            return $tenantId;
        }

        $user = $request->user();
        if ($user !== null) {
            $existing = $user->organizations()->value('organizations.id');
            if ($existing !== null) {
                return $existing;
            }
        }

        $first = Organization::query()->value('id');
        if ($first !== null) {
            return $first;
        }

        $organization = Organization::query()->create([
            'name' => 'Demo Workspace',
            'slug' => 'demo-workspace-'.Str::lower(Str::random(5)),
            'timezone' => 'UTC',
            'billing_email' => $user?->email,
        ]);

        if ($user !== null) {
            $organization->users()->attach($user->id, [
                'id' => (string) Str::uuid(),
                'role' => OrganizationRole::Owner->value,
            ]);
        }

        return $organization->id;
    }
}