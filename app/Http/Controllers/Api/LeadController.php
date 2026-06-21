<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Lead;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $orgId = app(TenantManager::class)->id();

        $leads = Lead::query()
            ->where('organization_id', $orgId)
            ->when($request->string('search')->isNotEmpty(), function ($query) use ($request) {
                $search = '%'.$request->string('search')->value().'%';

                $query->where(fn ($nested) => $nested
                    ->where('first_name', 'like', $search)
                    ->orWhere('last_name', 'like', $search)
                    ->orWhere('company', 'like', $search)
                    ->orWhere('email', 'like', $search));
            })
            ->latest()
            ->paginate(25);

        return response()->json($leads);
    }

    public function store(Request $request): JsonResponse
    {
        $payload = $request->validate([
            'first_name' => ['required', 'string', 'max:120'],
            'last_name' => ['nullable', 'string', 'max:120'],
            'linkedin_url' => ['nullable', 'url', 'max:255'],
            'headline' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:120'],
            'company' => ['nullable', 'string', 'max:120'],
            'industry' => ['nullable', 'string', 'max:120'],
            'location' => ['nullable', 'string', 'max:120'],
            'email' => ['nullable', 'email', 'max:190'],
            'phone' => ['nullable', 'string', 'max:50'],
            'website' => ['nullable', 'url', 'max:255'],
            'lead_score' => ['nullable', 'integer', 'between:0,100'],
            'status' => ['nullable', 'string', 'max:50'],
            'source' => ['nullable', 'string', 'max:80'],
            'notes' => ['nullable', 'string'],
        ]);

        $lead = Lead::query()->create([
            ...$payload,
            'organization_id' => app(TenantManager::class)->id(),
            'status' => $payload['status'] ?? 'new',
            'source' => $payload['source'] ?? 'manual',
            'lead_score' => $payload['lead_score'] ?? 0,
        ]);

        return response()->json($lead, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(
            Lead::query()
                ->where('organization_id', app(TenantManager::class)->id())
                ->findOrFail($id)
        );
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $lead = Lead::query()
            ->where('organization_id', app(TenantManager::class)->id())
            ->findOrFail($id);

        $lead->update($request->validate([
            'first_name' => ['sometimes', 'string', 'max:120'],
            'last_name' => ['sometimes', 'nullable', 'string', 'max:120'],
            'status' => ['sometimes', 'string', 'max:50'],
            'lead_score' => ['sometimes', 'integer', 'between:0,100'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]));

        return response()->json($lead->refresh());
    }

    public function destroy(string $id): JsonResponse
    {
        Lead::query()
            ->where('organization_id', app(TenantManager::class)->id())
            ->findOrFail($id)
            ->delete();

        return response()->json(status: 204);
    }
}
