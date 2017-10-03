<?php

namespace Noback\PHPUnitTestServiceContainer;

use Pimple\Container;
use Pimple\ServiceProviderInterface;

final class ServiceContainer extends Container
{
    /**
     * @var ServiceProvider[]
     */
    private $serviceProviders = [];

    public function register(ServiceProviderInterface $provider, array $values = array())
    {
        $this->serviceProviders[] = $provider;

        parent::register($provider, $values);
    }

    public function setUp()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->setUp($this);
        }
    }

    public function tearDown()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->tearDown($this);
        }
    }
}
