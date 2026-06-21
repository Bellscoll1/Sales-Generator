<?php

namespace App\Domain\Leads\Services;

use App\Domain\Leads\DTOs\LeadData;
use App\Domain\Leads\Repositories\LeadRepository;
use App\Models\Lead;

class LeadService
{
    public function __construct(private readonly LeadRepository $repository)
    {
    }

    public function createLead(LeadData $data): Lead
    {
        return $this->repository->create($data);
    }
}
