<?php

declare(strict_types=1);

namespace Cjmellor\BoostIdeBundle\Actions;

use Laravel\Boost\Install\CodeEnvironment\CodeEnvironment as BaseCodeEnvironment;
use ReflectionClass;
use ReflectionException;

class DiscoverCodeEnvironments
{
    public function __construct(
        private readonly string $directory,
        private readonly string $namespacePrefix,
    ) {}

    /**
     * @return array<int, array{name: string, class: class-string}>
     */
    public function run(): array
    {
        if (! is_dir($this->directory)) {
            return [];
        }

        $files = glob($this->directory.'/*.php');

        if ($files === false || count($files) === 0) {
            return [];
        }

        $descriptors = [];

        foreach ($files as $path) {
            $descriptor = $this->describeEnvironmentFromPath($path);

            if ($descriptor !== null) {
                $descriptors[] = $descriptor;
            }
        }

        return $descriptors;
    }

    /**
     * @return array{name: string, class: class-string}|null
     *
     * @throws ReflectionException
     */
    private function describeEnvironmentFromPath(string $path): ?array
    {
        $fqcn = $this->namespacePrefix.pathinfo($path, PATHINFO_FILENAME);

        if (! class_exists($fqcn)) {
            return null;
        }

        $ref = new ReflectionClass($fqcn);

        if (! $ref->isSubclassOf(BaseCodeEnvironment::class)) {
            return null;
        }

        $instance = $ref->newInstanceWithoutConstructor();

        $name = $ref->getMethod('name')->invoke($instance);

        return ['name' => $name, 'class' => $fqcn];
    }
}
