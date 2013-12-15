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
     * Will be called when the service provider is first registered
     *
     * Use the provided ServiceContainerInterface instance to register services and parameters.
     *
     * For example:
     *
     *   $serviceContainer['connection'] = $serviceContainer->share(function() {
     *       return new Connection();
     *   });
     */
    public function register(ServiceContainerInterface $serviceContainer);

    /**
     * Will be called before each test method in a test class (setUp)
     *
     * Use the provided ServiceContainerInterface instance to initialize services.
     *
     * For example:
     *
     *   $serviceContainer['database']->create();
     *   $serviceContainer['schema']->create($serviceContainer['database']);
     */
    public function setUp(ServiceContainerInterface $serviceContainer);

    /**
     * Will be called after each test method in a test class (tearDown)
     *
     * Use it to reset services with state, or remove other traces of the previous test.
     *
     *   $serviceContainer['database']->drop();
     */
    public function tearDown(ServiceContainerInterface $serviceContainer);
}
