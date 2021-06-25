<?php

namespace App\Repositories\Marketing;

use App\Models\Marketing\Campana;
use App\Repositories\BaseRepository;

class CampanaRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'campana',
        'from_name',
        'from_email',
        'asunto',
        'fecha',
        'status',
        'lista',
        'total_audiencia',
        'step',
        'email'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Campana::class;
    }
}
