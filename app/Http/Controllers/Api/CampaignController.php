<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CampaignController extends Controller
{
    public function index(): JsonResponse
    {
        $rows = Campaign::query()
            ->where('organization_id', app(TenantManager::class)->id())
            ->latest()
            ->paginate(20);

        return response()->json($rows);
    }

    public function store(Request $request): JsonResponse
    {
        $campaign = Campaign::query()->create([
            ...$request->validate([
                'name' => ['required', 'string', 'max:150'],
                'type' => ['required', 'string', 'max:50'],
                'status' => ['nullable', 'string', 'max:30'],
                'starts_at' => ['nullable', 'date'],
            ]),
            'organization_id' => app(TenantManager::class)->id(),
            'status' => $request->string('status')->value() ?: 'draft',
        ]);

        return response()->json($campaign, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(
            Campaign::query()
                ->where('organization_id', app(TenantManager::class)->id())
                ->findOrFail($id)
        );
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $campaign = Campaign::query()
            ->where('organization_id', app(TenantManager::class)->id())
            ->findOrFail($id);

        $campaign->update($request->validate([
            'name' => ['sometimes', 'string', 'max:150'],
            'status' => ['sometimes', 'string', 'max:30'],
            'starts_at' => ['sometimes', 'nullable', 'date'],
        ]));

        return response()->json($campaign->refresh());
    }
}
