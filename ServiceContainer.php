<?php

namespace Noback\PHPUnitTestServiceContainer;

use Noback\PHPUnitTestServiceContainer\Exception\ServiceContainerNotReadyException;

class ServiceContainer extends \Pimple implements ServiceContainerInterface
{
    private $setUpWasCalled = false;

    /**
     * @var ServiceProviderInterface[]
     */
    private $serviceProviders = array();

    public function register(ServiceProviderInterface $serviceProvider)
    {
        $serviceProvider->register($this);

        $this->serviceProviders[] = $serviceProvider;
    }

    public function setUp()
    {
        $this->setUpWasCalled = true;

        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->setUp($this);
        }
    }

    public function tearDown()
    {
        foreach ($this->serviceProviders as $serviceProvider) {
            $serviceProvider->tearDown($this);
        }
    }

    public function offsetExists($id)
    {
        $this->assertSetUpHasBeenCalled();

        return parent::offsetExists($id);
    }

    public function offsetGet($id)
    {
        $this->assertSetUpHasBeenCalled();

        return parent::offsetGet($id);
    }

    private function assertSetUpHasBeenCalled()
    {
        if (!$this->setUpWasCalled) {
            throw new ServiceContainerNotReadyException();
        }
    }
}
