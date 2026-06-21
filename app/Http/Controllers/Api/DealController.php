<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Deal;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DealController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Deal::query()->where('organization_id', app(TenantManager::class)->id())->latest()->paginate(20)
        );
    }

    public function store(Request $request): JsonResponse
    {
        $deal = Deal::query()->create([
            ...$request->validate([
                'name' => ['required', 'string', 'max:120'],
                'value' => ['required', 'numeric', 'min:0'],
                'owner_id' => ['nullable', 'uuid'],
                'probability' => ['nullable', 'integer', 'between:0,100'],
                'close_date' => ['nullable', 'date'],
                'stage' => ['required', 'string', 'max:40'],
                'notes' => ['nullable', 'string'],
            ]),
            'organization_id' => app(TenantManager::class)->id(),
            'probability' => $request->integer('probability', 10),
        ]);

        return response()->json($deal, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(
            Deal::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id)
        );
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $deal = Deal::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id);

        $deal->update($request->validate([
            'name' => ['sometimes', 'string', 'max:120'],
            'value' => ['sometimes', 'numeric', 'min:0'],
            'probability' => ['sometimes', 'integer', 'between:0,100'],
            'close_date' => ['sometimes', 'nullable', 'date'],
            'stage' => ['sometimes', 'string', 'max:40'],
            'notes' => ['sometimes', 'nullable', 'string'],
        ]));

        return response()->json($deal->refresh());
    }

    public function destroy(string $id): JsonResponse
    {
        Deal::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id)->delete();

        return response()->json(status: 204);
    }
}
