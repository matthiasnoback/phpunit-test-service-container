<?php
declare(strict_types=1);

namespace Noback\PHPUnitTestServiceContainer\PHPUnit;

use Noback\PHPUnitTestServiceContainer\ServiceContainer;
use Noback\PHPUnitTestServiceContainer\ServiceProvider;

/**
 * Extend from this test case to make use of a service container in your tests
 */
trait TestCaseWithServiceContainer
{
    /**
     * @var ServiceContainer
     */
    protected $container;

    /**
     * Return an array of ServiceProviderInterface instances you want to use in this test case
     *
     * @return ServiceProvider[]
     */
    abstract protected function getServiceProviders(): array;

    public function setUp(): void
    {
        $this->container = $this->createServiceContainer();

        $this->container->setUp();
    }

    private function createServiceContainer(): ServiceContainer
    {
        $container = new ServiceContainer();

        foreach ($this->getServiceProviders() as $serviceProvider) {
            $container->register($serviceProvider);
        }

        return $container;
    }

    public function tearDown(): void
    {
        $this->container->tearDown();
        $this->container = null;
    }
}
