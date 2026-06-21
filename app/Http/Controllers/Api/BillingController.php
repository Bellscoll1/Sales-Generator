<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class BillingController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json([
            'plans' => ['starter', 'professional', 'growth', 'enterprise'],
            'providers' => ['stripe', 'paddle'],
        ]);
    }
}
