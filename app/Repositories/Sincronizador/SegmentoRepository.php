<?php

namespace App\Repositories\Sincronizador;

use App\Models\Sincronizador\Segmento;
use App\Repositories\BaseRepository;

/**
 * Class SegmentoRepository
 * @package App\Repositories\Sincronizador
 * @version July 11, 2021, 10:21 am -04
*/

class SegmentoRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'seg_des',
        'c_cuenta',
        'p_cuenta',
        'dis_cen',
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
        return Segmento::class;
    }
}
