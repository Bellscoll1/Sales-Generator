<?php

namespace App\Http\Middleware;

use App\Models\Organization;
use App\Support\Tenancy\TenantManager;
use Closure;
use Illuminate\Http\Request;

class SetCurrentOrganization
{
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        $organizationId = $request->header('X-Organization-Id')
            ?? $request->query('organization_id')
            ?? $user?->organizations()->value('organizations.id');

        abort_if(empty($organizationId), 422, 'Organization context is required.');

        $organization = Organization::query()
            ->whereKey($organizationId)
            ->whereHas('users', fn ($query) => $query->where('users.id', $user->id))
            ->firstOrFail();

        app(TenantManager::class)->set($organization);

        return $next($request);
    }
}
