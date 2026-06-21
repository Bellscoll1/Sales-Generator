<?php

namespace App\Providers;

use App\Domain\AI\Contracts\AIClient;
use App\Domain\AI\Services\OpenAIClient;
use App\Domain\Billing\Contracts\BillingGateway;
use App\Domain\Billing\Services\StripeBillingGateway;
use Illuminate\Support\ServiceProvider;
use OpenAI;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(BillingGateway::class, function () {
            return new StripeBillingGateway(
                new StripeClient((string) config('services.stripe.secret'))
            );
        });

        $this->app->singleton(AIClient::class, function () {
            return new OpenAIClient(
                OpenAI::client((string) config('services.openai.key'))
            );
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
