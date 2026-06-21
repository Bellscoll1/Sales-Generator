<?php

namespace App\Domain\Billing\Contracts;

interface BillingGateway
{
    public function createCustomer(string $organizationId, string $email): string;

    public function createSubscription(string $customerId, string $planCode, int $seats): string;

    public function cancelSubscription(string $providerSubscriptionId): void;
}
