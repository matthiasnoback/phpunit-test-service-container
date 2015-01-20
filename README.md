# PHPUnit test service container

[![Build Status](https://travis-ci.org/matthiasnoback/phpunit-test-service-container.png?branch=master)](https://travis-ci.org/matthiasnoback/phpunit-test-service-container)

This library provides a simple service container which makes use of service providers. It also provides a base class for
your test cases which provides access to such a service container.

The service container extends the [Pimple dependency injection container](http://pimple.sensiolabs.org/).

Create your own service providers to configure any services you'd like to use in your unit tests.

Read more about using a service container to configure dependencies in unit tests (or integration tests) here:
http://php-and-symfony.matthiasnoback.nl/2013/06/phpunit-pimple-integration-tests-with-a-simple-di-container/
