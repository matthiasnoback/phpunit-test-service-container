<?php
declare(strict_types=1);

namespace Noback\PHPUnitTestServiceContainer\PHPUnit;

use Noback\PHPUnitTestServiceContainer\ServiceProvider;
use PHPUnit\Framework\TestCase;

final class TestCaseWithServiceContainerTest extends TestCase
{
    use TestCaseWithServiceContainer;

    /**
     * @var ServiceProviderSpy
     */
    private static $serviceProviderSpy;

    /**
     * Return an array of ServiceProviderInterface instances you want to use in this test case
     *
     * @return ServiceProvider[]
     */
    protected function getServiceProviders(): array
    {
        self::$serviceProviderSpy = new ServiceProviderSpy();

        return [self::$serviceProviderSpy];
    }

    /**
     * @test
     */
    public function it_has_called_setUp_on_the_service_provider()
    {
        self::assertTrue(self::$serviceProviderSpy->setUpCalled);
        self::assertFalse(self::$serviceProviderSpy->tearDownCalled);
    }

    /**
     * @afterClass
     */
    public static function verifyTearDown()
    {
        self::assertTrue(self::$serviceProviderSpy->tearDownCalled);
    }
}
