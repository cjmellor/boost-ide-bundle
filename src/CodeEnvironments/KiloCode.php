<?php

declare(strict_types=1);

namespace Cjmellor\BoostIdeBundle\CodeEnvironments;

use Laravel\Boost\Contracts\Agent;
use Laravel\Boost\Install\CodeEnvironment\CodeEnvironment;
use Laravel\Boost\Install\Enums\Platform;

class KiloCode extends CodeEnvironment implements Agent
{
    public function name(): string
    {
        return 'kilocode';
    }

    public function displayName(): string
    {
        return 'Kilo Code';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return [
            'files' => [],
        ];
    }

    public function projectDetectionConfig(): array
    {
        return [
            'paths' => ['.kilocode'],
            'files' => ['.kilocoderules'],
        ];
    }

    public function detectOnSystem(Platform $platform): bool
    {
        return false;
    }

    public function mcpClientName(): ?string
    {
        return null;
    }

    public function guidelinesPath(): string
    {
        return '.kilocode/rules/laravel-boost.md';
    }
}
