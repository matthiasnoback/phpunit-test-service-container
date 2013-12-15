<?php

namespace Noback\PHPUnitTestServiceContainer;

/**
 * Interface for simple service containers
 *
 * Mainly just an interface for \Pimple with some extra methods for this project
 */
interface ServiceContainerInterface extends \ArrayAccess
{
    // ServiceContainer methods

    public function register(ServiceProviderInterface $serviceProvider);

    public function setUp();

    public function tearDown();

    // Pimple methods

    public static function share($callable);

    public static function protect($callable);

    public function raw($id);

    public function extend($id, $callable);

    public function keys();
}
