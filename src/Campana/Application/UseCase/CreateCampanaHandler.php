<?php

namespace Epl\Campana\Application\UseCase;

use Epl\Campana\Domain\Entities\CampanaEntity;
use Epl\Campana\Domain\Contracts\CampanaRepository;

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
            $command->getCampana();
            $command->getFromName();
            $command->getFromEmail();
            $command->getAsunto();
            $command->getFecha();
            $command->getStatus();
            $command->getLista();
            $command->getTotalAudiencia();
            $command->getStep();
            $command->getEmail();
        );

        $this->repository->save($entity);
    }
}
