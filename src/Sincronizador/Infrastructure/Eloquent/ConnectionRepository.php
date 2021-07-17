<?php

namespace Epl\Sincronizador\Infrastructure\Eloquent;

use App\Models\Configuracion\Connection;
use Epl\Sincronizador\Domain\Contracts\InterfaceRespository;
use Epl\Sincronizador\Infrastructure\Repositories\BaseRepository;

final class ConnectionRepository extends BaseRepository implements InterfaceRespository
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
