<?php


namespace Noback\PHPUnitTestServiceContainer\Tests;

use Noback\PHPUnitTestServiceContainer\ServiceContainer;

class ServiceContainerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function it_allows_service_provider_to_register_services()
    {
        $serviceContainer = new ServiceContainer();

        $serviceProvider = $this->createMockServiceProvider('register', $serviceContainer);

        $serviceContainer->register($serviceProvider);
    }

    /**
     * @test
     */
    public function it_allows_service_provider_to_set_up_before_tests()
    {
        $serviceContainer = new ServiceContainer();

        $serviceProvider = $this->createMockServiceProvider('setUp', $serviceContainer);

        $serviceContainer->register($serviceProvider);

        $serviceContainer->setUp();
    }

    /**
     * @test
     */
    public function it_tears_down_service_providers_when_tearing_down_itself()
    {
        $serviceContainer = new ServiceContainer();

        $serviceProvider1 = $this->createMockServiceProvider('tearDown', $serviceContainer);
        $serviceProvider2 = $this->createMockServiceProvider('tearDown', $serviceContainer);

        $serviceContainer->register($serviceProvider1);
        $serviceContainer->register($serviceProvider2);

        $serviceContainer->tearDown();
    }

    /**
     * @test
     */
    public function it_warns_the_user_when_set_up_has_not_been_called()
    {
        $serviceContainer = new ServiceContainer();

        $this->setExpectedException('Noback\PHPUnitTestServiceContainer\Exception\ServiceContainerNotReadyException');

        $serviceContainer->offsetGet('some_service');
    }

    /**
     * @test
     */
    public function it_warns_the_user_when_set_up_has_not_been_called_and_isset_is_used()
    {
        $serviceContainer = new ServiceContainer();

        $this->setExpectedException('Noback\PHPUnitTestServiceContainer\Exception\ServiceContainerNotReadyException');

        $serviceContainer->offsetExists('some_service');
    }

    /**
     * @test
     */
    public function it_retrieves_the_service_when_set_up_has_been_called()
    {
        $serviceContainer = new ServiceContainer();
        $serviceContainer['some_service'] = $serviceContainer->share(
            function () {
                return new \stdClass();
            }
        );

        $serviceContainer->setUp();

        $serviceExists = $serviceContainer['some_service'];

        $this->assertInstanceOf('stdClass', $serviceExists);
    }

    /**
     * @test
     */
    public function it_verifies_if_a_service_exists_when_set_up_has_been_called()
    {
        $serviceContainer = new ServiceContainer();
        $serviceContainer['some_service'] = 'some value';

        $serviceContainer->setUp();

        $serviceExists = isset($serviceContainer['some_service']);

        $this->assertTrue($serviceExists);
    }

    private function createMockServiceProvider($method, ServiceContainer $serviceContainer)
    {
        $serviceProvider = $this->getMock('Noback\PHPUnitTestServiceContainer\ServiceProviderInterface');

        $serviceProvider
            ->expects($this->once())
            ->method($method)
            ->with($this->identicalTo($serviceContainer));

        return $serviceProvider;
    }
}
