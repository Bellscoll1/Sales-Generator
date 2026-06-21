<?php

namespace App\Domain\AI\Contracts;

interface AIClient
{
    public function generate(string $prompt, array $context = []): string;
}
