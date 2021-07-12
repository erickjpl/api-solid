<?php

namespace App\Repositories\Sincronizador;

use App\Models\Sincronizador\TipoAju;
use App\Repositories\BaseRepository;

/**
 * Class TipoAjuRepository
 * @package App\Repositories\Sincronizador
 * @version July 11, 2021, 10:17 am -04
*/

class TipoAjuRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'des_tipo',
        'tipo_trans',
        'campo1',
        'campo2',
        'campo3',
        'campo4',
        'co_us_in',
        'fe_us_in',
        'co_us_mo',
        'fe_us_mo',
        'co_us_el',
        'fe_us_el',
        'revisado',
        'trasnfe',
        'co_sucu',
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
        return TipoAju::class;
    }
}
