<?php

namespace Noback\PHPUnitTestServiceContainer\Exception;

class ServiceContainerNotReadyException extends \RuntimeException
{
    public function __construct()
    {
        parent::__construct('The service container is not ready, maybe you forgot to call parent::setUp() in your setUp method?');
    }
}
