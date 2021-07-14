<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent\Profit;

use App\Repositories\BaseRepository;
use App\Models\Sincronizador\Vendedor;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

class VendedorRepository extends BaseRepository implements InterfaceRespository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'tipo',
        'ven_des',
        'dis_cen',
        'cedula',
        'direc1',
        'direc2',
        'telefonos',
        'fecha_reg',
        'condic',
        'comision',
        'comen',
        'fun_cob',
        'fun_ven',
        'comisionv',
        'fac_ult_ve',
        'fec_ult_ve',
        'net_ult_ve',
        'cli_ult_ve',
        'cta_contab',
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
        'login',
        'password',
        'email',
        'PSW_M'
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
        return Vendedor::class;
    }
}
