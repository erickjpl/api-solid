<?php

namespace Epl\Campana\Application\UseCase;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Epl\Campana\Domain\Entities\CampanaEntity;
use Epl\Campana\Domain\Exceptions\ModelNotFound;
use Epl\Campana\Domain\Contracts\CampanaRepositoryInterface;

final class FindCampanaUseCase
{
  private $repository;

  public function __construct(CampanaRepositoryInterface $repository)
  {
   	 $this->repository = $repository;
  }

  public function execute(int $id)
  {
    try {
      $entity = $this->repository->find($id);
      
      CampanaEntity::map($entity);

      return $entity;
    } catch (ModelNotFound $exception) {
      throw $exception;
    }
  }
}
