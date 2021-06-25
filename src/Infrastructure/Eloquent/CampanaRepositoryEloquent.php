<?php

namespace Epl\Domain\Marketing;

use App\Models\Marketing\Campana;
use Epl\Domain\Marketing\CampanaEntity;
use Epl\Domain\Marketing\CampanaRepository;

final class CampanaRepositoryEloquent implements CampanaRepository
{
    private $model;

    public function __construct(Campana $model)
    {
        $this->model = $model;
    }

    public function save(CampanaEntity $entity)
    {
        $this->model->create($entity);
    }
}
