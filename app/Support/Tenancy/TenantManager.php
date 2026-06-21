<?php

namespace App\Support\Tenancy;

use App\Models\Organization;

class TenantManager
{
    private ?Organization $organization = null;

    public function set(?Organization $organization): void
    {
        $this->organization = $organization;
    }

    public function get(): ?Organization
    {
        return $this->organization;
    }

    public function id(): ?string
    {
        return $this->organization?->id;
    }
}
