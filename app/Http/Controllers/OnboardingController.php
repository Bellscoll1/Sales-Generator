<?php

namespace App\Http\Controllers;

use App\Enums\OrganizationRole;
use App\Models\Organization;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Inertia\Response;

class OnboardingController extends Controller
{
    public function show(Request $request): Response
    {
        return Inertia::render('Onboarding/Index', [
            'steps' => [
                'Create account',
                'Verify email',
                'Create workspace',
                'Invite team members',
                'Connect LinkedIn',
                'Create first campaign',
                'Import prospects',
                'Start outreach',
            ],
            'user' => $request->user(),
        ]);
    }

    public function storeWorkspace(Request $request): RedirectResponse
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:120'],
        ]);

        $organization = Organization::query()->create([
            'name' => $payload['name'],
            'slug' => Str::slug($payload['name']).'-'.Str::lower(Str::random(6)),
            'timezone' => 'UTC',
            'billing_email' => $request->user()->email,
        ]);

        $organization->users()->attach($request->user()->id, [
            'id' => (string) Str::uuid(),
            'role' => OrganizationRole::Owner->value,
        ]);

        return back();
    }

    public function invite(Request $request): RedirectResponse
    {
        $request->validate([
            'emails' => ['required', 'array', 'min:1'],
            'emails.*' => ['required', 'email'],
        ]);

        return back();
    }

    public function connectLinkedIn(Request $request): RedirectResponse
    {
        $request->validate([
            'linkedin_member_id' => ['required', 'string', 'max:120'],
        ]);

        return back();
    }
}
