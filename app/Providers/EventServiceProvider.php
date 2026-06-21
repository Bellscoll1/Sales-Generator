<?php

namespace App\Providers;

use App\Domain\Shared\Events\LeadImported;
use App\Domain\Shared\Listeners\SyncLeadToSearch;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        LeadImported::class => [
            SyncLeadToSearch::class,
        ],
    ];
}
