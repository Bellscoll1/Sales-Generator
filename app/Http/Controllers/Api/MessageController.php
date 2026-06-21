<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            Message::query()
                ->where('organization_id', app(TenantManager::class)->id())
                ->latest()
                ->paginate(30)
        );
    }

    public function store(Request $request): JsonResponse
    {
        $message = Message::query()->create([
            ...$request->validate([
                'conversation_id' => ['required', 'uuid'],
                'body' => ['required', 'string'],
                'direction' => ['required', 'in:inbound,outbound'],
                'scheduled_for' => ['nullable', 'date'],
            ]),
            'organization_id' => app(TenantManager::class)->id(),
            'sender_id' => $request->user()->id,
            'sent_at' => now(),
        ]);

        return response()->json($message, 201);
    }
}
