<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Support\Tenancy\TenantManager;
use Illuminate\Http\JsonResponse;

class OrganizationController extends Controller
{
    public function current(): JsonResponse
    {
        return response()->json(app(TenantManager::class)->get());
    }
}
