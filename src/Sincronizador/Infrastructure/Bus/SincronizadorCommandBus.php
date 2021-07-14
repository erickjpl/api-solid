<?php

namespace Epl\Sincronizador\Infrastructure\Bus;

use Epl\Sincronizador\Application\Contracts\Command;
use Epl\Sincronizador\Application\Bus\Contracts\Container;
use Epl\Sincronizador\Infrastructure\Bus\Contracts\SincronizadorBus;

final class SincronizadorCommandBus implements SincronizadorBus
{
  private const COMMAND_PREFIX = 'Command';
  private const HANDLER_PREFIX = 'Handler';

  private $container;

  public function __construct(Container $container)
  {
    $this->container = $container;
  }

  public function execute($command)
  {
    return $this->resolveHandler($command)->__invoke($command);
  }

  public function resolveHandler(Command $command)
  {
    return $this->container->make($this->getHandlerClass($command));
  }

  public function getHandlerClass(Command $command): string
  {
    return str_replace(
      array('Services', self::COMMAND_PREFIX),
      array('Handlers', self::HANDLER_PREFIX),
      get_class($command)
    );
  }
}
