<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent\Profit;

use App\Models\Sincronizador\Proceden;
use App\Repositories\BaseRepository;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

class ProcedenRepository extends BaseRepository implements InterfaceRespository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'des_proc',
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
        return Proceden::class;
    }

    public function all($search = [], $skip = null, $limit = null, $columns = ['*'])
    {
        $query = $this->allQuery([], $skip, $limit);

        $query = $query->whereBetween($search);

        return $query->get($columns);
    }
}
