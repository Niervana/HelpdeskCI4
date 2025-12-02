<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

/**
 * Application AI configuration
 *
 * Usage:
 * - Add `CLAUDE_HAIKU_ENABLED=true` to your `.env` to enable Claude Haiku for all clients.
 * - Access via `config('AI')->claudeHaikuEnabled` or `config(\Config\AI::class)->claudeHaikuEnabled`.
 */
class AI extends BaseConfig
{
    /**
     * Enable Claude Haiku 4.5 for all clients (boolean).
     * Read from environment variable `CLAUDE_HAIKU_ENABLED`.
     * Default: false
     *
     * @var bool
     */
    public bool $claudeHaikuEnabled;

    public function __construct()
    {
        // env() helper is available in CodeIgniter; use 'true'/'1' to enable
        $this->claudeHaikuEnabled = filter_var(getenv('CLAUDE_HAIKU_ENABLED') ?: env('CLAUDE_HAIKU_ENABLED'), FILTER_VALIDATE_BOOLEAN);
    }
}
