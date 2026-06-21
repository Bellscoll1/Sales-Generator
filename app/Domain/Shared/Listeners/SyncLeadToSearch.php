<?php

namespace App\Domain\Shared\Listeners;

use App\Domain\Shared\Events\LeadImported;
use App\Models\Lead;

class SyncLeadToSearch
{
    public function handle(LeadImported $event): void
    {
        $lead = Lead::query()
            ->where('organization_id', $event->organizationId)
            ->find($event->leadId);

        $lead?->searchable();
    }
}
