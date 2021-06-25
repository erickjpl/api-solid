<?php

namespace Epl\Campana\Infrastructure\Bus;

use Epl\Infrastructure\Bus\Contracts\CommandBus;
use Epl\Application\Bus\Contracts\Container;
use Epl\Application\Contracts\Command;

final class SimpleCommandBus implements CommandBus
{
    private const COMMAND_PREFIX = 'Command'; 
    private const HANDLER_PREFIX = 'Handler';
    
    private $commandBus;

    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    public function execute($command)
    {
        return $this->resolverHandler($command)->__invoke($command);
    }

    public function resolverHandler(Command $command)
    {
        return $this->container->make($this->getHandlerClass(command));
    }

    public function getHandlerClass(Command $command)
    {
        return str_replace(self::COMMAND_PREFIX, self::HANDLER_PREFIX, get_class($command));
    }
}
