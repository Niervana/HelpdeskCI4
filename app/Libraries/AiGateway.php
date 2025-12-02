<?php

namespace App\Libraries;

use Config\AI;

/**
 * Simple AI Gateway to centralize model selection.
 *
 * This class reads `Config\AI` and selects the model to use.
 * It provides a small `send()` stub that demonstrates which model
 * would be used. Integrate real provider calls here.
 */
class AiGateway
{
    protected AI $config;
    protected string $model;

    public function __construct()
    {
        $this->config = config(AI::class);
        $this->model = $this->determineModel();
    }

    protected function determineModel(): string
    {
        // When enabled, prefer Claude Haiku 4.5 for all clients
        if ($this->config->claudeHaikuEnabled) {
            return 'claude-haiku-4.5';
        }

        // Fallback/default model (adjust to your available models)
        return 'default-model';
    }

    /**
     * Get the selected model name.
     */
    public function getModel(): string
    {
        return $this->model;
    }

    /**
     * Send a request to the AI provider.
     *
     * NOTE: This is a stub. Replace with real HTTP client calls to your
     * AI provider (Anthropic, OpenAI, etc.) and include authentication.
     *
     * @param array $payload Arbitrary payload to send to the model/provider
     * @return array Example response structure for testing
     */
    public function send(array $payload): array
    {
        // Example: return the model and payload so callers can verify selection
        return [
            'model' => $this->getModel(),
            'payload' => $payload,
            'meta' => [
                'timestamp' => date('c'),
                'source' => 'AiGateway::send (stub)'
            ],
        ];
    }
}
