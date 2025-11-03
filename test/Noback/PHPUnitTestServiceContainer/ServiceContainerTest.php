<?php
declare(strict_types=1);

namespace Noback\PHPUnitTestServiceContainer;

use PHPUnit\Framework\TestCase;
use Smartschool\Db\DbalConnectionFactory;

final class ServiceContainerTest extends TestCase
{
    public function test_it_calls_setUp_on_all_providers()
    {
        $serviceProvider1 = $this->getMockBuilder(ServiceProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceProvider2 = $this->getMockBuilder(ServiceProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceContainer = new ServiceContainer();
        $serviceContainer->register($serviceProvider1);
        $serviceContainer->register($serviceProvider2);

        $serviceProvider1->expects(self::once())
            ->method('setUp')
            ->with($serviceContainer);

        $serviceProvider2->expects(self::once())
            ->method('setUp')
            ->with($serviceContainer);

        $serviceContainer->setUp();
    }

    public function test_it_calls_tearDown_on_all_providers()
    {
        $serviceProvider1 = $this
            ->getMockBuilder(ServiceProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceProvider2 = $this
            ->getMockBuilder(ServiceProvider::class)
            ->disableOriginalConstructor()
            ->getMock();

        $serviceContainer = new ServiceContainer();
        $serviceContainer->register($serviceProvider1);
        $serviceContainer->register($serviceProvider2);

        $serviceProvider1->expects(self::once())
            ->method('tearDown')
            ->with($serviceContainer);

        $serviceProvider2->expects(self::once())
            ->method('tearDown')
            ->with($serviceContainer);

        $serviceContainer->tearDown();
    }
}
