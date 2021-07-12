<?php

namespace Epl\Sincronizador\Application\Bus\Contracts;

interface Container
{
  public function make($class);
}
