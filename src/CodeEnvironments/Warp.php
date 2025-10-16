<?php

declare(strict_types=1);

namespace Cjmellor\BoostIdeBundle\CodeEnvironments;

use Laravel\Boost\Contracts\Agent;
use Laravel\Boost\Contracts\McpClient;
use Laravel\Boost\Install\CodeEnvironment\CodeEnvironment;
use Laravel\Boost\Install\Enums\Platform;

class Warp extends CodeEnvironment implements Agent, McpClient
{
    public function name(): string
    {
        return 'warp';
    }

    public function displayName(): string
    {
        return 'Warp';
    }

    public function systemDetectionConfig(Platform $platform): array
    {
        return match ($platform) {
            Platform::Darwin => [
                'paths' => [
                    '/Applications/Warp.app',
                    '/Applications/WarpPreview.app',
                ],
            ],
            Platform::Linux => [
                'command' => [
                    'which warp-terminal',
                    'which warp-terminal-preview',
                ],
            ],
            Platform::Windows => [
                'paths' => [
                    '%ProgramFiles%\\Warp',
                    '%ProgramFiles%\\WarpPreview',
                    '%LOCALAPPDATA%\\Programs\\Warp',
                    '%LOCALAPPDATA%\\Programs\\WarpPreview',
                ],
            ],
        };
    }

    public function projectDetectionConfig(): array
    {
        return [
            'files' => ['WARP.md'],
        ];
    }

    public function guidelinesPath(): string
    {
        return 'WARP.md';
    }

    public function frontmatter(): bool
    {
        return false;
    }
}
