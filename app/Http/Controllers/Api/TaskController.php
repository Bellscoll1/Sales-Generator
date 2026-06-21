<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Task::query()->where('organization_id', app(TenantManager::class)->id())->latest()->paginate(20)
        );
    }

    public function store(Request $request): JsonResponse
    {
        $task = Task::query()->create([
            ...$request->validate([
                'title' => ['required', 'string', 'max:140'],
                'type' => ['required', 'string', 'max:50'],
                'status' => ['nullable', 'string', 'max:40'],
                'due_at' => ['nullable', 'date'],
                'assigned_to' => ['nullable', 'uuid'],
                'meta' => ['nullable', 'array'],
            ]),
            'organization_id' => app(TenantManager::class)->id(),
            'status' => $request->string('status')->value() ?: 'open',
        ]);

        return response()->json($task, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json(
            Task::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id)
        );
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $task = Task::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id);

        $task->update($request->validate([
            'title' => ['sometimes', 'string', 'max:140'],
            'status' => ['sometimes', 'string', 'max:40'],
            'due_at' => ['sometimes', 'nullable', 'date'],
            'meta' => ['sometimes', 'nullable', 'array'],
        ]));

        return response()->json($task->refresh());
    }

    public function destroy(string $id): JsonResponse
    {
        Task::query()->where('organization_id', app(TenantManager::class)->id())->findOrFail($id)->delete();

        return response()->json(status: 204);
    }
}
