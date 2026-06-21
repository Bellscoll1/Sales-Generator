<?php

namespace App\Domain\AI\Services;

use App\Domain\AI\Contracts\AIClient;
use OpenAI\Client;

class OpenAIClient implements AIClient
{
    public function __construct(private readonly Client $client)
    {
    }

    public function generate(string $prompt, array $context = []): string
    {
        $response = $this->client->responses()->create([
            'model' => 'gpt-4.1-mini',
            'input' => $prompt.'\n'.json_encode($context),
        ]);

        return (string) ($response->outputText ?? '');
    }
}
