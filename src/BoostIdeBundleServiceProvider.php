<?php

declare(strict_types=1);

namespace Cjmellor\BoostIdeBundle;

use Cjmellor\BoostIdeBundle\Actions\DiscoverCodeEnvironments;
use Illuminate\Support\ServiceProvider;
use Laravel\Boost\Boost;

class BoostIdeBundleServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $environments = (new DiscoverCodeEnvironments(
            __DIR__.'/CodeEnvironments',
            __NAMESPACE__.'\\CodeEnvironments\\')
        )->run();

        foreach ($environments as $environment) {
            Boost::registerCodeEnvironment($environment['name'], $environment['class']);
        }
    }
}
