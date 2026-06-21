<?php

namespace App\Domain\Shared\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class LeadImported
{
    use Dispatchable;
    use SerializesModels;

    public function __construct(public string $leadId, public string $organizationId)
    {
    }
}
