<?php

namespace Noback\PHPUnitTestServiceContainer;

/**
 * Implement this interface to extend service containers
 *
 * A service provider is allowed to register services to the service container.
 */
interface ServiceProviderInterface
{
    /**
     * Will be called before each test method in a test class (setUp)
     *
     * Use the provided ServiceContainerInterface instance to register services.
     *
     * For example:
     *
     *   $serviceContainer['connection'] = $serviceContainer->share(function() {
     *       return new Connection();
     *   });
     */
    public function setUp(ServiceContainerInterface $serviceContainer);

    /**
     * Will be called after each test method in a test class (tearDown)
     *
     * Use it to reset services with state, or remove other traces of the previous test.
     *
     *   $serviceContainer['database']->drop();
     *   $serviceContainer['database']->create();
     *   $serviceContainer['schema']->create($serviceContainer['database']);
     */
    public function tearDown(ServiceContainerInterface $serviceContainer);
}
