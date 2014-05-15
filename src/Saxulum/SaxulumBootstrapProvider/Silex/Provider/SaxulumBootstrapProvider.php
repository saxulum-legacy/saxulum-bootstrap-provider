<?php

namespace Saxulum\SaxulumBootstrapProvider\Silex\Provider;

use Saxulum\SaxulumBootstrapProvider\Provider\SaxulumBootstrapProvider as PimpleSaxulumBootstrapProvider;
use Silex\Application;
use Silex\ServiceProviderInterface;

class SaxulumBootstrapProvider implements ServiceProviderInterface
{
    /**
     * @param Application $app
     */
    public function register(Application $app)
    {
        $saxulumPaginationProvider = new PimpleSaxulumBootstrapProvider();
        $saxulumPaginationProvider->register($app);
    }

    /**
     * @param Application $app
     */
    public function boot(Application $app) {}
}
