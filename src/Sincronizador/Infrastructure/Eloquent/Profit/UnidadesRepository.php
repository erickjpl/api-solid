<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent\Profit;

use App\Models\Sincronizador\Unidades;
use App\Repositories\BaseRepository;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

class UnidadesRepository extends BaseRepository implements InterfaceRespository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'des_uni',
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
        'rowguid',
        'row_id'
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
        return Unidades::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery([], $skip, $limit);

        $query = $query->whereBetween($search);

        return $query->get($columns);
    }
}