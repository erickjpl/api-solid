<?php

namespace Epl\Application\Bus\Contracts;

interface Container
{
    public function make($class);
}
