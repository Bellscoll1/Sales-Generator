<?php

namespace App\Domain\Billing\Services;

use App\Domain\Billing\Contracts\BillingGateway;
use Stripe\StripeClient;

class StripeBillingGateway implements BillingGateway
{
    public function __construct(private readonly StripeClient $stripe)
    {
    }

    public function createCustomer(string $organizationId, string $email): string
    {
        $customer = $this->stripe->customers->create([
            'email' => $email,
            'metadata' => ['organization_id' => $organizationId],
        ]);

        return $customer->id;
    }

    public function createSubscription(string $customerId, string $planCode, int $seats): string
    {
        $subscription = $this->stripe->subscriptions->create([
            'customer' => $customerId,
            'items' => [[
                'price' => $planCode,
                'quantity' => $seats,
            ]],
        ]);

        return $subscription->id;
    }

    public function cancelSubscription(string $providerSubscriptionId): void
    {
        $this->stripe->subscriptions->cancel($providerSubscriptionId, []);
    }
}
