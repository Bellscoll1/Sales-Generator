<?php

namespace App\Http\Middleware;

use App\Enums\OrganizationRole;
use App\Support\Tenancy\TenantManager;
use Closure;
use Illuminate\Http\Request;

class CheckOrganizationRole
{
    public function handle(Request $request, Closure $next, string $minimumRole)
    {
        $organization = app(TenantManager::class)->get();
        $user = $request->user();

        abort_unless($organization && $user, 403);

        $currentRole = $organization->users()
            ->where('users.id', $user->id)
            ->first()?->pivot?->role;

        abort_unless($currentRole, 403);

        $current = OrganizationRole::from($currentRole);
        $required = OrganizationRole::from($minimumRole);

        abort_if($current->level() < $required->level(), 403, 'Insufficient role.');

        return $next($request);
    }
}
