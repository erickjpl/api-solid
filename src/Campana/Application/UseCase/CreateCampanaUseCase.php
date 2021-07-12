<?php

namespace Epl\Campana\Application\UseCase;

use Epl\Campana\Domain\Entities\CampanaEntity;
use Epl\Campana\Application\Handlers\CampanaHandler;
use Epl\Campana\Infrastructure\Eloquent\CampanaRepository;

final class CreateCampanaUseCase
{
    private $repository;

    public function __construct(CampanaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function execute(CampanaHandler $payload)
    {
        $entity = new CampanaEntity(
            $payload->getCampana(),
            $payload->getFromName(),
            $payload->getFromEmail(),
            $payload->getAsunto(),
            $payload->getFecha(),
            $payload->getStatus(),
            $payload->getLista(),
            $payload->getTotalAudiencia(),
            $payload->getStep(),
            $payload->getEmail()
        );

        $collect = $this->repository->create($entity->toArray());

        return CampanaEntity::fromArray($collect->toArray());
    }
}
