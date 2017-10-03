<?php
declare(strict_types=1);

namespace Noback\PHPUnitTestServiceContainer\PHPUnit;

use Noback\PHPUnitTestServiceContainer\ServiceContainer;
use Noback\PHPUnitTestServiceContainer\ServiceProvider;
use Pimple\Container;

final class ServiceProviderSpy implements ServiceProvider
{
    private $container;
    public $setUpCalled = false;
    public $tearDownCalled = false;

    public function setUp(ServiceContainer $serviceContainer)
    {
        if ($serviceContainer !== $this->container) {
            throw new \LogicException();
        }

        $this->setUpCalled = true;
    }

    public function tearDown(ServiceContainer $serviceContainer)
    {
        if ($serviceContainer !== $this->container) {
            throw new \LogicException();
        }

        $this->tearDownCalled = true;
    }

    public function register(Container $pimple)
    {
        $this->container = $pimple;
    }
}
