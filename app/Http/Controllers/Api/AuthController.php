<?php

namespace App\Http\Controllers\Api;

use App\Enums\OrganizationRole;
use App\Http\Controllers\Controller;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $payload = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'email' => ['required', 'email', 'max:190', 'unique:users,email'],
            'password' => ['required', 'string', 'min:8'],
            'organization_name' => ['required', 'string', 'max:120'],
        ]);

        $user = User::query()->create([
            'name' => $payload['name'],
            'email' => $payload['email'],
            'password' => Hash::make($payload['password']),
        ]);

        $organization = Organization::query()->create([
            'name' => $payload['organization_name'],
            'slug' => Str::slug($payload['organization_name']).'-'.Str::lower(Str::random(5)),
            'billing_email' => $payload['email'],
            'timezone' => 'UTC',
        ]);

        $organization->users()->attach($user->id, [
            'id' => (string) Str::uuid(),
            'role' => OrganizationRole::Owner->value,
        ]);

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user,
            'organization' => $organization,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string'],
        ]);

        $user = User::query()->where('email', $credentials['email'])->first();

        abort_unless($user && Hash::check($credentials['password'], $user->password), 422, 'Invalid credentials.');

        return response()->json([
            'token' => $user->createToken('api')->plainTextToken,
            'user' => $user,
            'organizations' => $user->organizations,
        ]);
    }

    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()?->delete();

        return response()->json(['message' => 'Logged out.']);
    }

    public function me(Request $request): JsonResponse
    {
        return response()->json($request->user()->load('organizations'));
    }
}
