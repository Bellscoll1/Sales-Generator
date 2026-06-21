<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\Deal;
use App\Models\Lead;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;

class ReportController extends Controller
{
    public function index(): JsonResponse
    {
        $orgId = app(TenantManager::class)->id();

        return response()->json([
            'lead_count' => Lead::query()->where('organization_id', $orgId)->count(),
            'active_campaigns' => Campaign::query()->where('organization_id', $orgId)->where('status', 'active')->count(),
            'pipeline_value' => Deal::query()->where('organization_id', $orgId)->sum('value'),
        ]);
    }
}
