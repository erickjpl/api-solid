<?php

namespace Epl\Application\Services\Marketing;

use Epl\Domain\Marketing\CampanaEntity;
use Epl\Domain\Marketing\CampanaRepository;

final class CreateCampanaHandler implements Handler
{
    private $repository;

    public function __construct(CampanaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function __invoke($command)
    {
        $entity = new CampanaEntity(
            $command->getId();
        );

        $this->repository->save($entity);
    }
}
