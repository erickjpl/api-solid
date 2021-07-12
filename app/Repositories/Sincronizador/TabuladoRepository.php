<?php

namespace App\Repositories\Sincronizador;

use App\Models\Sincronizador\Tabulado;
use App\Repositories\BaseRepository;

/**
 * Class TabuladoRepository
 * @package App\Repositories\Sincronizador
 * @version July 11, 2021, 10:23 am -04
*/

class TabuladoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'descripcio',
        'porc_vent',
        'porc_comp',
        'porc_cxs',
        'porc_otro',
        'revisado',
        'trasnfe',
        'rowguid'
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
        return Tabulado::class;
    }
}
