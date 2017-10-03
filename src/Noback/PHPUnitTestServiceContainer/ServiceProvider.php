<?php

namespace Noback\PHPUnitTestServiceContainer;

use Pimple\ServiceProviderInterface;

/**
 * Implement this interface to extend service containers
 *
 * A service provider is allowed to register services to the service container.
 */
interface ServiceProvider extends ServiceProviderInterface
{
    /**
     * Will be called before each test method in a test class (setUp)
     *
     * Use the provided ServiceContainerInterface instance to initialize services.
     *
     * For example:
     *
     *   $serviceContainer['database']->create();
     *   $serviceContainer['schema']->create($serviceContainer['database']);
     *
     * @param ServiceContainer $serviceContainer
     * @return void
     */
    public function setUp(ServiceContainer $serviceContainer);

    /**
     * Will be called after each test method in a test class (tearDown)
     *
     * Use it to reset services with state, or remove other traces of the previous test.
     *
     *   $serviceContainer['database']->drop();
     *
     * @param ServiceContainer $serviceContainer
     * @return void
     */
    public function tearDown(ServiceContainer $serviceContainer);
}
