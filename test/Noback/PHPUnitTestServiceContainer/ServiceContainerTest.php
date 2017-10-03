<?php
declare(strict_types=1);

namespace Noback\PHPUnitTestServiceContainer;

use PHPUnit\Framework\TestCase;

final class ServiceContainerTest extends TestCase
{
    /**
     * @test
     */
    public function it_calls_setUp_on_all_providers()
    {
        $serviceProvider1 = $this->prophesize(ServiceProvider::class);
        $serviceProvider2 = $this->prophesize(ServiceProvider::class);

        $serviceContainer = new ServiceContainer();
        $serviceContainer->register($serviceProvider1->reveal());
        $serviceContainer->register($serviceProvider2->reveal());

        $serviceContainer->setUp();

        $serviceProvider1->setUp($serviceContainer)->shouldHaveBeenCalled();
        $serviceProvider2->setUp($serviceContainer)->shouldHaveBeenCalled();
    }

    /**
     * @test
     */
    public function it_calls_tearDown_on_all_providers()
    {
        $serviceProvider1 = $this->prophesize(ServiceProvider::class);
        $serviceProvider2 = $this->prophesize(ServiceProvider::class);

        $serviceContainer = new ServiceContainer();
        $serviceContainer->register($serviceProvider1->reveal());
        $serviceContainer->register($serviceProvider2->reveal());

        $serviceContainer->tearDown();

        $serviceProvider1->tearDown($serviceContainer)->shouldHaveBeenCalled();
        $serviceProvider2->tearDown($serviceContainer)->shouldHaveBeenCalled();
    }
}
