<?php

namespace Epl\Infrastructure\Bus;

use Epl\Application\Bus\Contracts\Container;
use Illuminate\Container\Container as IoC;

final class LaravelContainer implements Container
{
    private $container;

    public function __construct(IoC $container)
    {
        $this->container = $container;
    }

    public function make($class)
    {
        return $this->container->make($class);
    }
}
