<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use App\Models\Sincronizador\Tabulado;
use App\Repositories\BaseRepository;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;

class TabuladoRepository extends BaseRepository implements InterfaceRespository
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
