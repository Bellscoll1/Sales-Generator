<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WebhookController extends Controller
{
    public function stripe(Request $request): JsonResponse
    {
        return response()->json(['received' => true, 'provider' => 'stripe']);
    }

    public function paddle(Request $request): JsonResponse
    {
        return response()->json(['received' => true, 'provider' => 'paddle']);
    }
}
