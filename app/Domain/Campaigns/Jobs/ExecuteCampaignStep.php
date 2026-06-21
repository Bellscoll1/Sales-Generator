<?php

namespace App\Domain\Campaigns\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ExecuteCampaignStep implements ShouldQueue
{
    use Dispatchable;
    use InteractsWithQueue;
    use Queueable;
    use SerializesModels;

    public function __construct(public string $campaignEnrollmentId)
    {
        $this->onQueue('default');
    }

    public function handle(): void
    {
        // Campaign step execution placeholder for message, email, and task actions.
    }
}
