<?php

namespace Epl\Campana\Domain\Contracts;

interface CampanaRepositoryInterface
{
    public function getFieldsSearchable();

    public function model();
}
