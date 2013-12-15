<?php

namespace Noback\PHPUnitTestServiceContainer\PHPUnit;

use Noback\PHPUnitTestServiceContainer\ServiceContainer;
use Noback\PHPUnitTestServiceContainer\ServiceContainerInterface;
use Noback\PHPUnitTestServiceContainer\ServiceProviderInterface;

/**
 * Extend from this test case to make use of a service container in your tests
 */
abstract class AbstractTestCaseWithServiceContainer extends \PHPUnit_Framework_TestCase
{
    /**
     * @var ServiceContainerInterface
     */
    protected $container;

    /**
     * Return an array of ServiceProviderInterface instances you want to use in this test case
     *
     * @return ServiceProviderInterface[]
     */
    abstract protected function getServiceProviders();

    /**
     * When overriding this method, make sure you call parent::setUp()
     */
    protected function setUp()
    {
        $this->container = $this->createServiceContainer();

        $this->container->setUp();
    }

    protected function createServiceContainer()
    {
        $container = new ServiceContainer();

        foreach ($this->getServiceProviders() as $serviceProvider) {
            $container->register($serviceProvider);
        }

        return $container;
    }

    /**
     * When overriding this method, make sure you call parent::tearDown()
     */
    protected function tearDown()
    {
        $this->container->tearDown();
        $this->container = null;
    }
}
