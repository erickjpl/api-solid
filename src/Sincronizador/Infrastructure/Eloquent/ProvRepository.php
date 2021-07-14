<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use App\Models\Sincronizador\Prov;
use App\Repositories\BaseRepository;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

class ProvRepository extends BaseRepository implements InterfaceRespository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'prov_des',
        'co_seg',
        'co_zon',
        'inactivo',
        'productos',
        'direc1',
        'direc2',
        'telefonos',
        'fax',
        'respons',
        'fecha_reg',
        'tipo',
        'com_ult_co',
        'fec_ult_co',
        'net_ult_co',
        'saldo',
        'saldo_ini',
        'mont_cre',
        'plaz_pag',
        'desc_ppago',
        'desc_glob',
        'tipo_iva',
        'iva',
        'rif',
        'nacional',
        'dis_cen',
        'nit',
        'email',
        'co_ingr',
        'comentario',
        'campo1',
        'campo2',
        'campo3',
        'campo4',
        'campo5',
        'campo6',
        'campo7',
        'campo8',
        'co_us_in',
        'fe_us_in',
        'co_us_mo',
        'fe_us_mo',
        'co_us_el',
        'fe_us_el',
        'revisado',
        'trasnfe',
        'co_sucu',
        'rowguid',
        'juridico',
        'tipo_adi',
        'matriz',
        'co_tab',
        'tipo_per',
        'co_pais',
        'ciudad',
        'zip',
        'website',
        'formtype',
        'taxid',
        'porc_esp',
        'contribu_e'
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
        return Prov::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery([], $skip, $limit);

        $query = $query->whereBetween($search);

        return $query->get($columns);
    }
}
