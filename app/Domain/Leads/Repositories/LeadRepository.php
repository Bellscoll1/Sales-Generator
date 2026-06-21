<?php

namespace App\Domain\Leads\Repositories;

use App\Domain\Leads\DTOs\LeadData;
use App\Models\Lead;

class LeadRepository
{
    public function create(LeadData $data): Lead
    {
        return Lead::query()->create([
            'organization_id' => $data->organizationId,
            'first_name' => $data->firstName,
            'last_name' => $data->lastName,
            'linkedin_url' => $data->linkedinUrl,
            'company' => $data->company,
            'email' => $data->email,
            'status' => $data->status,
            'lead_score' => $data->leadScore,
        ]);
    }
}
