<?php
// phpcs:disable PSR1.Classes.ClassDeclaration.MissingNamespace

use Fuel\Dependency\Container as FuelContainer;

class Container
{
    private static $instance;

    private static $providers = [
        \Provider\Provider::class,
    ];

    public static function getInstance()
    {
        if (is_null(static::$instance)) {
            static::$instance = new FuelContainer;

            foreach (static::$providers as $provider) {
                static::$instance->addServiceProvider($provider);
            }
        }

        return static::$instance;
    }

    public static function __callStatic($method, $arguments)
    {
        return call_user_func_array([static::getInstance(), $method], $arguments);
    }
}
