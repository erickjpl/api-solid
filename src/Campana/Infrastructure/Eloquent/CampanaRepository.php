<?php

namespace Epl\Domain\Marketing;

use App\Models\Marketing\Campana;
use Epl\Campana\Domain\Entities\CampanaEntity;
use Epl\Campana\Domain\Contracts\CampanaRepository;

final class CampanaRepository extends BaseRepository implements CampanaInterface
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
