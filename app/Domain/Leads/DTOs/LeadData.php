<?php

namespace App\Domain\Leads\DTOs;

class LeadData
{
    public function __construct(
        public readonly string $organizationId,
        public readonly string $firstName,
        public readonly ?string $lastName,
        public readonly ?string $linkedinUrl,
        public readonly ?string $company,
        public readonly ?string $email,
        public readonly string $status,
        public readonly int $leadScore,
    ) {
    }

    public static function fromArray(array $payload, string $organizationId): self
    {
        return new self(
            organizationId: $organizationId,
            firstName: $payload['first_name'],
            lastName: $payload['last_name'] ?? null,
            linkedinUrl: $payload['linkedin_url'] ?? null,
            company: $payload['company'] ?? null,
            email: $payload['email'] ?? null,
            status: $payload['status'] ?? 'new',
            leadScore: (int) ($payload['lead_score'] ?? 0),
        );
    }
}
