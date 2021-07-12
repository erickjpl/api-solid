<?php

namespace App\Repositories\Configuracion;

use App\Models\Configuracion\Connection;
use App\Repositories\BaseRepository;

/**
 * Class ConnectionRepository
 * @package App\Repositories\Configuracion
 * @version July 11, 2021, 4:33 pm -04
*/

class ConnectionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'shop',
        'start_date',
        'status'
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
        return Connection::class;
    }
}
