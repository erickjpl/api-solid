<?php

namespace Epl\Campana\Domain\Contracts;

use Epl\Campana\Domain\Entities\CampanaEntity;

interface CampanaRepository
{
    public function save(CampanaEntity $entity);
}
